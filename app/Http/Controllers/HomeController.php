<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\Domain;
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
        $user = User::findOrFail(Auth::user()->id);
        return view('profile.home', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail(Auth::user()->id);
        return view('profile.edit', compact('user'));
    }
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'name'      => $request->name,
            'email'     => $request->email,
        ]);
        return redirect('/home');
    }

    private function getNameServer($domain){

    }

    private function getDomainProperty($domain){
        $client = new Client();
        $url = 'https://mxtoolbox.com/SuperTool.aspx?action=whois%3amatuisichiro.com&run=toolpage';
        $res = $client->request('GET', $url, ['headers' => ['User-Agent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36']]);
        $hasil = $res->getBody();

        $expiration = self::get_string_between($hasil, '<span>Expires on ', '</span><br><span>Updated on ');
        // $nameserver1 = self::get_string_between($hasil, 'Name Servers</td><td>', '(has ');
        // $nameserver2 = self::get_string_between($hasil, 'domains)<br>', '(has ');
        // $domain = array("expiration"=>$expiration, "nameserver1"=>$nameserver1, "nameserver2"=>$nameserver2);

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
