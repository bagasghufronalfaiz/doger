<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\Website;
use App\Models\Domain;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class WebsiteController extends Controller
{

    public function index()
    {
        if(Auth::check())
        {
            $user = User::findOrFail(Auth::user()->id);
            return view('welcome', compact('user'));
        } else {
            return view('welcome-copy');
        }
    }

    public function create()
    {
        $user = User::findOrFail(Auth::user()->id);
        return view('website.create', compact('user'));
    }

    public function store(Request $request)
    {
        //select domain name from table domain
        $selectdomain = Domain::where('id', $request->domain)->first();
        $domeng = $selectdomain->domain;

        // get index web and index iamge
        $index_image = self::getIndexImage($domeng);
        $index_web = self::getIndexWeb($domeng);

        // set date from string to date
        $date = $request->date;
        $time = strtotime($date);
        $newdate = date('Y-m-d', $time);

        // get wordpress theme
        $theme = self::getWordpressTheme($domeng);

        //
        $slug = str_replace_first('.', '', $domeng);

        $website = Website::create([
            'domain_id' => $request->domain,
            'theme' => $theme,
            'index_web' => $index_web,
            'index_image' => $index_image,
            'keyword' => $request->keyword,
            'server_id' => $request->servercok,
            'server_folder' => $request->server_folder,
            'ad_id' => $request->ad,
            'date' => $newdate,
            'webmaster_id' => $request->webmaster,
            'slug'  => $slug,
            'user_id' => Auth::user()->id,
        ]);

        return redirect('/');
    }

    public function show($slug)
    {
        $website = Website::where('slug', $slug)->first();
        if($website->userisOwner()){
            if (empty($website)) {
                abort(404);
            }
            return view('website.single', compact('website'));
        } else {
            abort(403);
        }
    }

    public function edit($id)
    {
        $website = Website::findOrFail($id);
        if($website->userisOwner()){
            $user = User::findOrFail(Auth::user()->id);
            return view('website.edit', compact('website', 'user'));
        } else {
            abort(403);
        }
    }

    public function update(Request $request, $id)
    {
        $date = $request->date;
        $time = strtotime($date);
        $newdate = date('Y-m-d', $time);

        $website = Website::findOrFail($id);
        if ($website->userisOwner()) {
          $website->update([
            'domain_id' => $request->domain,
            'keyword' => $request->keyword,
            'server_id' => $request->servercok,
            'server_folder' => $request->server_folder,
            'ad_id' => $request->ad,
            'date' => $newdate,
            'webmaster_id' => $request->webmaster,
          ]);
        }else {
          abort(403);
        }

        return redirect('/');
    }

    public function destroy($id)
    {
        $website = Website::findOrFail($id);
        if ($website->userisOwner()) {
            $website->delete();
        }else {
            abort(403);
        }

        return redirect('/');
    }

    private function getStringBetween($string, $start, $end){
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }

    private function getIndexImage($domaing)
    {
        $client = new Client();

        $url = 'https://www.google.com/search?q=site:'.$domaing.'&tbm=isch&sout=1';
        $res = $client->request('GET', $url, ['headers' => ['User-Agent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36']]);
        $hasil = $res->getBody();

        $strindex = self::getStringBetween($hasil, '<div class="sd" id="resultStats">Sekitar ', ' hasil</div>');
        $index = (int) filter_var($strindex, FILTER_SANITIZE_NUMBER_INT);
        return $index;
    }

    private function getIndexWeb($domaing)
    {
        $client = new Client();

        $url = 'https://www.google.com/search?q=site:'.$domaing.'&sout=1';
        $res = $client->request('GET', $url, ['headers' => ['User-Agent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36']]);
        $hasil = $res->getBody();

        $strindex = self::getStringBetween($hasil, '<div id="resultStats">Sekitar ', ' hasil<nobr>');
        $index = (int) filter_var($strindex, FILTER_SANITIZE_NUMBER_INT);
        return $index;
    }

    // public function refresh_index($domaing)
    // {
    //     $client = new Client();
    //     $url = 'https://www.google.com/search?q=site:'.$domaing.'&tbm=isch&sout=1';
    //     $res = $client->request('GET', $url);
    //     $hasil = $res->getBody();

    //     $strindex = self::getStringBetween($hasil, '<div class="sd" id="resultStats">Sekitar ', ' hasil</div>');
    //     $index = (int) filter_var($strindex, FILTER_SANITIZE_NUMBER_INT);

    //     $domainname = Domain::where('domain', $domaing)->first();
    //     $domainid = $domainname->id;
    //     $website = Website::where('domain_id', $domainid)->first();
    //         $website->update([
    //             'index' => $index,
    //         ]);
    //     return $index;
    // }

    public function refreshIndexImage($domaing)
    {
        $index = self::getIndexImage($domaing);

        $domainname = Domain::where('domain', $domaing)->first();
        $domainid = $domainname->id;
        $website = Website::where('domain_id', $domainid)->first();
            $website->update([
                'index_image' => $index,
            ]);
        return $index;
    }

    public function refreshIndexWeb($domaing)
    {
        $index = self::getIndexWeb($domaing);

        $domainname = Domain::where('domain', $domaing)->first();
        $domainid = $domainname->id;
        $website = Website::where('domain_id', $domainid)->first();
        $website->update([
            'index_web' => $index,
        ]);
        return $index;
    }

    private function getWordpressTheme($domain)
    {
        $client = new Client();
        $url = 'http://' . $domain . '/';
        $res = $client->request('GET', $url, ['headers' => ['User-Agent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36']]);
        $hasil = $res->getBody();
        $before = 'http://' . $domain . '/wp-content/themes/';
        $theme = self::getStringBetween($hasil, $before, '/style.css');
        return $theme;
    }

}
