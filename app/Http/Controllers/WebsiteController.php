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

        // get index web and index image
        $index_image = self::getIndexImage($domeng);
        $index_web = self::getIndexWeb($domeng);

        // set date from string to date
        $date = $request->date;
        $time = strtotime($date);
        $newdate = date('Y-m-d', $time);

        // get wordpress theme
        $theme = self::getWordpressTheme($domeng);

        //slug
        $slug = str_replace_first('.', '', $domeng);

        // Wordpress
        // Get Posts
        $posts = self::getWordpressPosts($domeng);
        // Get Pages
        $pages = self::getWordpressPages($domeng);
        // Get All Page Titles
        $pageTitles = self::getAllWordpressPageTitles($domeng, $pages);
        // Get Categories
        $categories = self::getWordpressCategories($domeng);
        // Get All Category Titles
        $categoryTitles = self::getAllWordpressCategoryTitles($domeng, $categories);

        $website = Website::create([
            'domain_id'         => $request->domain,
            'theme'             => $theme,
            'index_web'         => $index_web,
            'index_image'       => $index_image,
            'keyword'           => $request->keyword,
            'tool'              => $request->tool,
            'server_id'         => $request->servername,
            'server_folder'     => $request->serverfolder,
            'ad_id'             => $request->ad,
            'date'              => $newdate,
            'webmaster_id'      => $request->webmaster,
            'slug'              => $slug,
            'wp_posts'          => $posts,
            'wp_pages'          => $pages,
            'wp_page_titles'    => $pageTitles,
            'wp_categories'     => $categories,
            'wp_category_titles'=> $categoryTitles,
            'user_id'       => Auth::user()->id,
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
        $newdate = date('m/d/Y', $time);
        if($website->userisOwner()){
            $user = User::findOrFail(Auth::user()->id);
            return view('website.edit', compact('website', 'user', 'newdate'));
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
            'domain_id'         => $request->domain,
            'keyword'           => $request->keyword,
            'server_id'         => $request->servername,
            'server_folder'     => $request->serverfolder,
            'ad_id'             => $request->ad,
            'tool'              => $request->tool,
            'date'              => $newdate,
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

    public function refreshWordpressTheme($domaing)
    {
        $theme = self::getWordpressTheme($domaing);

        $domainName = Domain::where('domain', $domaing)->first();
        $domainId = $domainName->id;
        $website = Website::where('domain_id', $domainId)->first();
        if ($website->userisOwner()) {
            $website->update([
                'theme' => $theme,
            ]);
            return response()->json([
                'theme' => $theme,
            ]);
        } else {
            return 'mbuh';
        }
    }

    private function getWordpressPosts($domain)
    {
        $client = new Client();
        $url = 'http://' . $domain . '/wp-json/wp/v2/posts';
        $res = $client->request('GET', $url, ['headers' => ['User-Agent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36']]);
        $posts = $res->getHeader('x-wp-total')[0];

        return $posts;
    }

    public function refreshWordpressPost($domaing)
    {
        $post = self::getWordpressPosts($domaing);

        $domainName = Domain::where('domain', $domaing)->first();
        $domainId = $domainName->id;
        $website = Website::where('domain_id', $domainId)->first();
        if ($website->userisOwner()) {
            $website->update([
                'wp_posts' => $post,
            ]);
            return response()->json([
                'post' => $post,
            ]);
        } else {
            return 'mbuh';
        }
    }

    private function getWordpressPages($domain)
    {
        $client = new Client();
        $url = 'http://' . $domain . '/wp-json/wp/v2/pages';
        $res = $client->request('GET', $url, ['headers' => ['User-Agent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36']]);
        $pages = $res->getHeader('x-wp-total')[0];

        return $pages;
    }

    public function refreshWordpressPage($domaing)
    {
        $page = self::getWordpressPages($domaing);

        $domainName = Domain::where('domain', $domaing)->first();
        $domainId = $domainName->id;
        $website = Website::where('domain_id', $domainId)->first();
        if ($website->userisOwner()) {
            $website->update([
                'wp_pages' => $page,
            ]);
            return response()->json([
                'page' => $page,
            ]);
        } else {
            return 'mbuh';
        }
    }

    private function getWordpressPageTitles($domain, $total_pages)
    {
        $client = new Client();
        $url = 'http://' . $domain . '/wp-json/wp/v2/pages?per_page=1&page=' . $total_pages;
        $res = $client->request('GET', $url, ['headers' => ['User-Agent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36']]);
        $hasil = $res->getBody();
        $kacang = json_decode($hasil, true);
        $panjang = $kacang[0]['title']['rendered'];
        return $panjang;
    }

    private function getAllWordpressPageTitles($domain, $total_pages)
    {
        $pageTitles = '';
        for ($count = 1; $count <= $total_pages; $count++) {
            $hasil[$count] = self::getWordpressPageTitles($domain, $count);

            if ($count == $total_pages) {
                $pageTitles = $pageTitles . $hasil[$count];
            } else {
                $pageTitles = $pageTitles . $hasil[$count] . ', ';
            }
        }
        return $pageTitles;
    }

    public function refreshWordpressPageTitle($domaing)
    {
        $domainName = Domain::where('domain', $domaing)->first();
        $domainId = $domainName->id;
        $website = Website::where('domain_id', $domainId)->first();

        $websitePage = $website->wp_pages;
        $pageTitle = self::getAllWordpressPageTitles($domaing, $websitePage);

        if ($website->userisOwner()) {
            $website->update([
                'wp_page_titles' => $pageTitle,
            ]);
            return response()->json([
                'page-title' => $pageTitle,
            ]);
        } else {
            return 'mbuh';
        }
    }

    private function getWordpressCategories($domain)
    {
        $client = new Client();
        $url = 'http://' . $domain . '/wp-json/wp/v2/categories';
        $res = $client->request('GET', $url, ['headers' => ['User-Agent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36']]);
        $header = $res->getHeader('x-wp-total')[0];

        return $header;
    }

    public function refreshWordpressCategory($domaing)
    {
        $category = self::getWordpressCategories($domaing);

        $domainName = Domain::where('domain', $domaing)->first();
        $domainId = $domainName->id;
        $website = Website::where('domain_id', $domainId)->first();
        if ($website->userisOwner()) {
            $website->update([
                'wp_categories' => $category,
            ]);
            return response()->json([
                'category' => $category,
            ]);
        } else {
            return 'mbuh';
        }
    }

    private function getWordpressCategoryTitles($domain, $total_category)
    {
        $client = new Client();
        $url = 'http://' . $domain . '/wp-json/wp/v2/categories?per_page=1&page=' . $total_category;
        $res = $client->request('GET', $url, ['headers' => ['User-Agent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36']]);
        $hasil = $res->getBody();
        $kacang = json_decode($hasil, true);
        $panjang = $kacang[0]['name'];
        return $panjang;
    }

    private function getAllWordpressCategoryTitles($domain, $total_pages)
    {
        $categoryTitles = '';
        for ($count = 1; $count <= $total_pages; $count++) {
            $hasil[$count] = self::getWordpressCategoryTitles($domain, $count);

            if ($count == $total_pages) {
                $categoryTitles = $categoryTitles . $hasil[$count];
            } else {
                $categoryTitles = $categoryTitles . $hasil[$count] . ', ';
            }
        }
        return $categoryTitles;
    }

    public function refreshWordpressCategoryTitle($domaing)
    {
        $domainName = Domain::where('domain', $domaing)->first();
        $domainId = $domainName->id;
        $website = Website::where('domain_id', $domainId)->first();

        $websiteCategory = $website->wp_categories;
        $categoryTitle = self::getAllWordpressCategoryTitles($domaing, $websiteCategory);

        if ($website->userisOwner()) {
            $website->update([
                'wp_category_titles' => $categoryTitle,
            ]);
            return response()->json([
                'category-title' => $categoryTitle,
            ]);
        } else {
            return 'mbuh';
        }
    }

}
