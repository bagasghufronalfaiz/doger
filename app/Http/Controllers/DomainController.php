<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Domain;
use App\Models\User;
use App\Models\Registrar;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class DomainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = User::findOrFail(Auth::user()->id);

        return view('domain.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::findOrFail(Auth::user()->id);
        return view('domain.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $domeng = $request->domain;
        $cek_index = self::get_index($domeng);
        if ($cek_index==''){
            $index_status = 0;
        } else {
            $index_status = 1;
        }
        
        $domain = Domain::create([
            'domain' => $request->domain,
            'pa' => $request->pa,
            'da' => $request->da,
            'expiration' => $request->expiration,
            'nameserver1' => $request->nameserver1,
            'nameserver2' => $request->nameserver2,
            'index_status' => $index_status,
            'registrar_id' => $request->registrar_id,
            'user_id' => Auth::user()->id,
        ]);

        return redirect('domain');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Domain  $domain
     * @return \Illuminate\Http\Response
     */
    public function show(Domain $domain)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Domain  $domain
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $domain = Domain::findOrFail($id);
        if($domain->userisOwner()){
            $user = User::findOrFail(Auth::user()->id);
            return view('domain.edit', compact('domain', 'user'));
        } else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Domain  $domain
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $domain = Domain::findOrFail($id);
        if ($domain->userisOwner()) {
          $domain->update([
            'domain' => $request->domain,
            'pa' => $request->pa,
            'da' => $request->da,
            'expiration' => $request->expiration,
            'nameserver1' => $request->nameserver1,
            'nameserver2' => $request->nameserver2,
            'index_status' => $request->index_status,
            'registrar_id' => $request->registrar_id
          ]);
        }else {
          abort(403);
        }

        return redirect('domain')->with('msg', 'domain  berhasil di edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Domain  $domain
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $domain = Domain::findOrFail($id);
        if ($domain->userisOwner()) {
            $domain->delete();
        }else {
            abort(403);
        }

        return redirect('domain');
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
        $asd = 'https://www.google.com/search?q=site:$domain&tbm=isch&sout=1';
        $url = 'https://www.google.com/search?q=site:'.$domaing.'&tbm=isch&sout=1';
        $res = $client->request('GET', $url);
        $hasil = $res->getBody(); 
        
        return self::get_string_between($hasil, '<div class="sd" id="resultStats">Sekitar ', ' hasil</div>');
    }
}
