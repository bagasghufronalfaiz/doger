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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::findOrFail(Auth::user()->id);
        return view('website.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $selectdomain = Domain::where('id', $request->domain)->first();
        $domeng = $selectdomain->domain;

        $index = self::get_index($domeng);
        $index_web = self::get_index_web($domeng);

        return $index.'spasi'.$index_web;
        $date = $request->date;
        $time = strtotime($date);
        $newdate = date('Y-m-d', $time);

        $website = Website::create([
            'domain_id' => $request->domain,
            'theme' => $request->theme,
            'index' => $index,
            'keyword' => $request->keyword,
            'server_id' => $request->servercok,
            'server_folder' => $request->server_folder,
            'ad_id' => $request->ad,
            'date' => $newdate,
            'webmaster_id' => $request->webmaster,
            'user_id' => Auth::user()->id,
        ]);

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $date = $request->date;
        $time = strtotime($date);
        $newdate = date('Y-m-d', $time);

        $website = Website::findOrFail($id);
        if ($website->userisOwner()) {
          $website->update([
            'domain_id' => $request->domain,
            'theme' => $request->theme,
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    private function get_string_between($string, $start, $end){
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }

    private function get_index($domaing)
    {
        $client = new Client();
        $url = 'https://www.google.com/search?q=site:'.$domaing.'&tbm=isch&sout=1';
        $res = $client->request('GET', $url, ['headers' => ['User-Agent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36']]);
        $hasil = $res->getBody();

        $strindex = self::get_string_between($hasil, '<div class="sd" id="resultStats">Sekitar ', ' hasil</div>');
        $index = (int) filter_var($strindex, FILTER_SANITIZE_NUMBER_INT);
        return $index;
    }

    private function get_index_web($domaing)
    {
        $client = new Client();
        
        $url = 'https://www.google.com/search?q=site:'.$domaing.'&sout=1';
        $url2 = 'https://www.google.com/search?q=site%3A'.$domaing.'&oq=site%3A&aqs=chrome.2.69i57j69i58j69i59j69i65l3.5379j0j9&sourceid=chrome&ie=UTF-8';
        //$client->Request('GET', 'https://www.google.com/search?q=site:'.$domain->domain_name.'&sout=1', ['headers' => ['User-Agent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36']]);
        $res = $client->request('GET', $url, ['headers' => ['User-Agent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36']]);
        $hasil = $res->getBody();

        $strindex = self::get_string_between($hasil, '<div id="resultStats">Sekitar ', ' hasil<nobr>');
        $index = (int) filter_var($strindex, FILTER_SANITIZE_NUMBER_INT);
        return $index;
    }

    

    public function refresh_index($domaing)
    {
        $client = new Client();
        $url = 'https://www.google.com/search?q=site:'.$domaing.'&tbm=isch&sout=1';
        $res = $client->request('GET', $url);
        $hasil = $res->getBody();

        $strindex = self::get_string_between($hasil, '<div class="sd" id="resultStats">Sekitar ', ' hasil</div>');
        $index = (int) filter_var($strindex, FILTER_SANITIZE_NUMBER_INT);

        $domainname = Domain::where('domain', $domaing)->first();
        $domainid = $domainname->id;
        $website = Website::where('domain_id', $domainid)->first();
            $website->update([
                'index' => $index,
            ]);
        return $index;
    }

    // public function save_and_check($domaing)
    // {
    //     $check = self::get_index($domaing);
    //     if ($check != false) {
    //         /// Save database
    //         if (saved) {
    //             return $check;
    //         } else {

    //         }
    //         // return $check
    //     }
    // }
}
