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

        // //get total post
        // $damin = 'besthdwallpaper.co';
        // $header = self::get_wp_post_count($damin);
        // return $header;

        // get total pages
        // $damin = 'besthdwallpaper.co';
        // $jumlah_page = self::get_wp_page_count($damin);

        // // get wp pages title
        // $damin = 'besthdwallpaper.co';
        // $coba = 'worldivided.com';
        // $jumlah_page = self::get_wp_page_count($damin);
        // for($i=1;$i<=$jumlah_page;$i++){
        //     $hasil[$i] = self::get_wp_pages_title($damin, $i);
        // }
        // return $hasil[1] . ' dan ' . $hasil[2] . ' dan ' . $hasil[3] . ' dan ' . $hasil[4];

        // // get theme
        // $saming = 'bestwallpapers.co';
        // $result = self::get_theme($saming);
        // return $result;

        // coba str remove dot
        $saming = 'brand-google.com';
        $hasil = str_replace_first('.','', $saming);
        return $hasil;
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
        $hasil = $res->getBody();

        return $hasil;
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



}
