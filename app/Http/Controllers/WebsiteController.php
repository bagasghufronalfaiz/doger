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
            return view('home', compact('user'));
        } else {
            return view('landing');
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
        $selectDomain = Domain::where('id', $request->domain)->first();
        $domain = $selectDomain->domain;

        // get index web and index image
        $indexImage = self::getIndexImage($domain);
        $indexWeb = self::getIndexWeb($domain);

        // set date from string to date
        $date = $request->date;
        $time = strtotime($date);
        $newDate = date('Y-m-d', $time);

        // get wordpress theme
        $theme = self::getWordpressTheme($domain);

        //slug
        $slug = str_replace_first('.', '', $domain);

        // Wordpress
        // Get Posts
        $post = self::getWordpressPost($domain);
        // Get Pages
        $page = self::getWordpressPage($domain);
        // Get All Page Titles
        $pageTitle = self::getAllWordpressPageTitle($domain, $page);
        // Get Categories
        $category = self::getWordpressCategory($domain);
        // Get All Category Titles
        $categoryTitle = self::getAllWordpressCategoryTitle($domain, $category);

        $website = Website::create([
            'domain_id'         => $request->domain,
            'theme'             => $theme,
            'index_web'         => $indexWeb,
            'index_image'       => $indexImage,
            'keyword'           => $request->keyword,
            'tool'              => $request->tool,
            'server_id'         => $request->server_name,
            'server_folder'     => $request->server_folder,
            'ad_id'             => $request->ad,
            'date'              => $newDate,
            'webmaster_id'      => $request->webmaster,
            'slug'              => $slug,
            'wp_post'           => $post,
            'wp_page'           => $page,
            'wp_page_title'     => $pageTitle,
            'wp_category'       => $category,
            'wp_category_title' => $categoryTitle,
            'user_id'           => Auth::user()->id,
        ]);

        return redirect('/');
    }

    public function show($slug)
    {
        $website = Website::where('slug', $slug)->first();
        if (empty($website)) {
            abort(404);
        } else {
            if ($website->userisOwner()) {
                return view('website.single', compact('website'));
            } else {
                abort(403);
            }
        }

    }

    public function edit($id)
    {
        $website = Website::findOrFail($id);
        $date = $website->date;
        $time = strtotime($date);
        $newDate = date('m/d/Y', $time);
        if($website->userisOwner()){
            $user = User::findOrFail(Auth::user()->id);
            return view('website.edit', compact('website', 'user', 'newDate'));
        } else {
            abort(403);
        }
    }

    public function update(Request $request, $id)
    {
        $date = $request->date;
        $time = strtotime($date);
        $newDate = date('Y-m-d', $time);

        $website = Website::findOrFail($id);
        if ($website->userisOwner()) {
          $website->update([
            'domain_id'         => $request->domain,
            'keyword'           => $request->keyword,
            'server_id'         => $request->server_name,
            'server_folder'     => $request->server_folder,
            'ad_id'             => $request->ad,
            'tool'              => $request->tool,
            'date'              => $newDate,
            'webmaster_id'      => $request->webmaster,
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

    private function getIndexImage($domain)
    {
        $client = new Client();

        $url = 'https://www.google.com/search?q=site:'.$domain.'&tbm=isch&sout=1';
        $res = $client->request('GET', $url, ['headers' => ['User-Agent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36']]);
        $hasil = $res->getBody();

        $strIndex = self::getStringBetween($hasil, '<div class="sd" id="resultStats">Sekitar ', ' hasil</div>');
        $index = (int) filter_var($strIndex, FILTER_SANITIZE_NUMBER_INT);
        return $index;
    }

    private function getIndexWeb($domain)
    {
        $client = new Client();

        $url = 'https://www.google.com/search?q=site:'.$domain.'&sout=1';
        $res = $client->request('GET', $url, ['headers' => ['User-Agent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36']]);
        $hasil = $res->getBody();

        $strIndex = self::getStringBetween($hasil, '<div id="resultStats">Sekitar ', ' hasil<nobr>');
        $index = (int) filter_var($strIndex, FILTER_SANITIZE_NUMBER_INT);
        return $index;
    }

    public function refreshIndexImage($domain)
    {
        $domainName = Domain::where('domain', $domain)->first();
        $domainId = $domainName->id;
        $website = Website::where('domain_id', $domainId)->first();
        if ($website->userisOwner()) {
            $index = self::getIndexImage($domain);
            $website->update([
                'index_image' => $index,
            ]);
            return response()->json([
                'index-image' => $index,
            ]);
        } else {
            return response()->json([
                'index-image' => 'Access Denied',
            ]);
        }
    }

    public function refreshIndexWeb($domain)
    {
        $domainName = Domain::where('domain', $domain)->first();
        $domainId = $domainName->id;
        $website = Website::where('domain_id', $domainId)->first();
        if ($website->userisOwner()) {
            $index = self::getIndexWeb($domain);
            $website->update([
                'index_web' => $index,
            ]);
            return response()->json([
                'index-web' => $index,
            ]);
        } else {
            return response()->json([
                'index-web' => 'Access Denied',
            ]);
        }
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

    public function refreshWordpressTheme($domain)
    {
        $domainName = Domain::where('domain', $domain)->first();
        $domainId = $domainName->id;
        $website = Website::where('domain_id', $domainId)->first();
        if ($website->userisOwner()) {
            $theme = self::getWordpressTheme($domain);
            $website->update([
                'theme' => $theme,
            ]);
            return response()->json([
                'theme' => $theme,
            ]);
        } else {
            return response()->json([
                'theme' => 'Access Denied',
            ]);
        }
    }

    private function getWordpressPost($domain)
    {
        $client = new Client();
        $url = 'http://' . $domain . '/wp-json/wp/v2/posts';
        $res = $client->request('GET', $url, ['headers' => ['User-Agent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36']]);
        $posts = $res->getHeader('x-wp-total')[0];

        return $posts;
    }

    public function refreshWordpressPost($domain)
    {
        $domainName = Domain::where('domain', $domain)->first();
        $domainId = $domainName->id;
        $website = Website::where('domain_id', $domainId)->first();
        if ($website->userisOwner()) {
            $post = self::getWordpressPost($domain);
            $website->update([
                'wp_post' => $post,
            ]);
            return response()->json([
                'post' => $post,
            ]);
        } else {
            return response()->json([
                'post' => 'Access Denied',
            ]);
        }
    }

    private function getWordpressPage($domain)
    {
        $client = new Client();
        $url = 'http://' . $domain . '/wp-json/wp/v2/pages';
        $res = $client->request('GET', $url, ['headers' => ['User-Agent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36']]);
        $pages = $res->getHeader('x-wp-total')[0];

        return $pages;
    }

    public function refreshWordpressPage($domain)
    {
        $domainName = Domain::where('domain', $domain)->first();
        $domainId = $domainName->id;
        $website = Website::where('domain_id', $domainId)->first();
        if ($website->userisOwner()) {
            $page = self::getWordpressPage($domain);
            $website->update([
                'wp_page' => $page,
            ]);
            return response()->json([
                'page' => $page,
            ]);
        } else {
            return response()->json([
                'page' => 'Access Denied',
            ]);
        }
    }

    private function getWordpressPageTitle($domain, $totalPage)
    {
        $client = new Client();
        $url = 'http://' . $domain . '/wp-json/wp/v2/pages?per_page=1&page=' . $totalPage;
        $res = $client->request('GET', $url, ['headers' => ['User-Agent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36']]);
        $hasil = $res->getBody();
        $kacang = json_decode($hasil, true);
        $panjang = $kacang[0]['title']['rendered'];
        return $panjang;
    }

    private function getAllWordpressPageTitle($domain, $totalPage)
    {
        $pageTitle = '';
        for ($count = 1; $count <= $totalPage; $count++) {
            $hasil[$count] = self::getWordpressPageTitle($domain, $count);

            if ($count == $totalPage) {
                $pageTitle = $pageTitle . $hasil[$count];
            } else {
                $pageTitle = $pageTitle . $hasil[$count] . ', ';
            }
        }
        return $pageTitle;
    }

    public function refreshWordpressPageTitle($domain)
    {
        $domainName = Domain::where('domain', $domain)->first();
        $domainId = $domainName->id;
        $website = Website::where('domain_id', $domainId)->first();

        if ($website->userisOwner()) {
            $websitePage = $website->wp_page;
            $pageTitle = self::getAllWordpressPageTitle($domain, $websitePage);
            $website->update([
                'wp_page_title' => $pageTitle,
            ]);
            return response()->json([
                'page-title' => $pageTitle,
            ]);
        } else {
            return response()->json([
                'page-title' => 'Access Denied',
            ]);
        }
    }

    private function getWordpressCategory($domain)
    {
        $client = new Client();
        $url = 'http://' . $domain . '/wp-json/wp/v2/categories';
        $res = $client->request('GET', $url, ['headers' => ['User-Agent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36']]);
        $header = $res->getHeader('x-wp-total')[0];

        return $header;
    }

    public function refreshWordpressCategory($domain)
    {
        $domainName = Domain::where('domain', $domain)->first();
        $domainId = $domainName->id;
        $website = Website::where('domain_id', $domainId)->first();
        if ($website->userisOwner()) {
            $category = self::getWordpressCategory($domain);
            $website->update([
                'wp_category' => $category,
            ]);
            return response()->json([
                'category' => $category,
            ]);
        } else {
            return response()->json([
                'category' => 'Access Denied',
            ]);
        }
    }

    private function getWordpressCategoryTitle($domain, $totalCategory)
    {
        $client = new Client();
        $url = 'http://' . $domain . '/wp-json/wp/v2/categories?per_page=1&page=' . $totalCategory;
        $res = $client->request('GET', $url, ['headers' => ['User-Agent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36']]);
        $hasil = $res->getBody();
        $kacang = json_decode($hasil, true);
        $panjang = $kacang[0]['name'];
        return $panjang;
    }

    private function getAllWordpressCategoryTitle($domain, $totalPage)
    {
        $categoryTitle = '';
        for ($count = 1; $count <= $totalPage; $count++) {
            $hasil[$count] = self::getWordpressCategoryTitle($domain, $count);

            if ($count == $totalPage) {
                $categoryTitle = $categoryTitle . $hasil[$count];
            } else {
                $categoryTitle = $categoryTitle . $hasil[$count] . ', ';
            }
        }
        return $categoryTitle;
    }

    public function refreshWordpressCategoryTitle($domain)
    {
        $domainName = Domain::where('domain', $domain)->first();
        $domainId = $domainName->id;
        $website = Website::where('domain_id', $domainId)->first();

        if ($website->userisOwner()) {
            $websiteCategory = $website->wp_category;
            $categoryTitle = self::getAllWordpressCategoryTitle($domain, $websiteCategory);
            $website->update([
                'wp_category_title' => $categoryTitle,
            ]);
            return response()->json([
                'category-title' => $categoryTitle,
            ]);
        } else {
            return response()->json([
                'category-title' => 'Access Denied',
            ]);
        }
    }
}
