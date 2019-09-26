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
        // $idss = 'brand-google.com';
        // $dua = 'worldivided.com';
        // $tiga = 'google.com';
        // $cek_index = self::get_index($idss);
        // $cek = (int) filter_var($cek_index, FILTER_SANITIZE_NUMBER_INT);
        // //settype($cek_index, "integer");
        // if ($cek_index==''){
        //     $index_status = 0;
        // } else {
        //     $index_status = 1;
        // }

        // return $index_status;
        
        $dummy = Jajal::create([
            'index' => 'home'
        ]);
        return view('home');
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
}
