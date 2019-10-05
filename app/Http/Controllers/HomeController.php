<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Jajal;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // cron job
        // $dummy = Jajal::create([
        //     'index' => 'home'
        // ]);
        // return view('home');

        // wordpress API
        // $damin = 'supercampquin.com';
        // $hasil = self::get_wp_categories($damin);
        // // $kacang = var_dump(json_decode($hasil));
        // $panjang = json_decode($hasil, true);
        // $itung = count($panjang);
        // // return $panjang[1];
        // return $itung;

        //get total post
        $damin = 'besthdwallpaper.co';
        $posts = self::get_wp_post_count($damin);
        // return $posts;

        // get total pages
        // $damin = 'besthdwallpaper.co';
        $pages = self::get_wp_page_count($damin);

        // // get wp pages title
        // $damin = 'besthdwallpaper.co';
        // $coba = 'worldivided.com';
        // $page_titles = self::get_wp_page_count($damin);
        $new_page_titles = '';
        for($i=1;$i<= $pages;$i++){
            $hasil[$i] = self::get_wp_pages_title($damin, $i);
            if ($i == $pages) {
                $new_page_titles = $new_page_titles . $hasil[$i];
            } else {
                $new_page_titles = $new_page_titles . $hasil[$i] . ', ';
            }
        }
        // $new_page_titles = $hasil[1] . ', ' . $hasil[2] . ', ' . $hasil[3] . ', ' . $hasil[4];

        // // get theme
        // $saming = 'bestwallpapers.co';
        $theme = self::get_theme($damin);
        // return $result;

        // get categories
        $category = self::get_wp_categories($damin);
        // get category titles
        // $category_titles = '';
        // for ($j = 1; $j <= $category; $j++) {
        //     $hasil[$j] = self::get_wp_category_titles($damin, $j);
        //     if($j == $category){
        //         $category_titles = $category_titles . $hasil[$j];
        //     } else {
        //         $category_titles = $category_titles . $hasil[$j] . ', ';
        //     }
        //     // $category_titles = $category_titles . $hasil[$j] . ', ';
        // }
        $category_titles = self::getAllWpPages($damin, $category);

        // coba str remove dot
        // $saming = 'brand-google.com';
        // $hasil = str_replace_first('.','', $saming);
        return 'posts : '. $posts.' dan pages : '.$pages.' yaitu '.$new_page_titles.' dan category : '. $category.' yaitu '. $category_titles . ' dan theme : '. $theme;
    }

    private function get_string_between($string, $start, $end){
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }



    private function get_index($domain)
    {
        $client = new Client();
        //$asd = 'https://www.google.com/search?q=site:$domain&tbm=isch&sout=1';
        $url = 'http://matuisichiro.com/wp-admin/';
        //$res = $client->request('GET', $url);
        $res = $client->request('GET', $url, ['auth' => ['admin', '27desember1993']]);
        $hasil = $res->getBody();

        return $hasil;
        //return self::get_string_between($hasil, '<div class="sd" id="resultStats">Sekitar ', ' hasil</div>');
    }



    private function get_wp_categories($domain)
    {
        $client = new Client();
        $url = 'http://'.$domain.'/wp-json/wp/v2/categories';
        $res = $client->request('GET', $url, ['headers' => ['User-Agent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36']]);
        $header = $res->getHeader('x-wp-total')[0];

        return $header;
    }

    private function get_wp_category_titles($domain, $total_category)
    {
        $client = new Client();
        $url = 'http://' . $domain . '/wp-json/wp/v2/categories?per_page=1&page=' . $total_category;
        $res = $client->request('GET', $url, ['headers' => ['User-Agent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36']]);
        $hasil = $res->getBody();
        $kacang = json_decode($hasil, true);
        $panjang = $kacang[0]['name'];
        return $panjang;
    }



    private function get_wp_post_count($domain)
    {
        $client = new Client();
        $url = 'http://' . $domain . '/wp-json/wp/v2/posts';
        $res = $client->request('GET', $url, ['headers' => ['User-Agent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36']]);
        $header = $res->getHeader('x-wp-total')[0];
        $hasil = $res->getBody();

        return $header;
    }



    private function get_wp_page_count($domain)
    {
        $client = new Client();
        $url = 'http://' . $domain . '/wp-json/wp/v2/pages';
        $res = $client->request('GET', $url, ['headers' => ['User-Agent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36']]);
        $header = $res->getHeader('x-wp-total')[0];
        $hasil = $res->getBody();

        return $header;
    }

    private function get_theme($domain){
        $client = new Client();
        $url = 'http://' . $domain . '/';
        $res = $client->request('GET', $url, ['headers' => ['User-Agent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36']]);
        $hasil = $res->getBody();
        $before = 'http://'. $domain.'/wp-content/themes/';
        $theme = self::get_string_between($hasil, $before, '/style.css');
        return $theme;
    }


    private function get_wp_pages_title($domain, $total_pages){
        $client = new Client();
        $url = 'http://' . $domain . '/wp-json/wp/v2/pages?per_page=1&page='.$total_pages;
        $res = $client->request('GET', $url, ['headers' => ['User-Agent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36']]);
        $hasil = $res->getBody();
        $kacang = json_decode($hasil, true);
        $panjang = $kacang[0]['title']['rendered'];
        return $panjang;

    }

    private function getAllWpPages($domain, $total_pages)
    {
        $category_titles = '';
        for ($count = 1; $count <= $total_pages; $count++) {
            $hasil[$count] = self::get_wp_category_titles($domain, $count);

            if ($count == $total_pages) {
                $category_titles = $category_titles . $hasil[$count];
            } else {
                $category_titles = $category_titles . $hasil[$count] . ', ';
            }
        }
        return $category_titles;
    }

    private function getAllWordpressCategoryTitles($domain, $total_pages)
    {
        $categoryTitles = '';
        for ($count = 1; $count <= $total_pages; $count++) {
            $hasil[$count] = self::get_wp_category_titles($domain, $count);

            if ($count == $total_pages) {
                $categoryTitles = $categoryTitles . $hasil[$count];
            } else {
                $categoryTitles = $categoryTitles . $hasil[$count] . ', ';
            }
        }
        return $categoryTitles;
    }

}
