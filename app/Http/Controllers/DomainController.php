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
        // $expiration = $request->expiration;
        // $time = strtotime($expiration);
        // $newexpiration = date('Y-m-d', $time);

        $domain = $request->domain;
        $statusIndex = self::getStatusIndex($domain);

        $property = self::getDomainProperty($domain);
        
        $domain = Domain::create([
            'domain' => $request->domain,
            'expiration' => $property["expiration"],
            'nameserver1' => $property["nameserver1"],
            'nameserver2' => $property["nameserver2"],
            'index_status' => $statusIndex,
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
        $expiration = $request->expiration;
        $time = strtotime($expiration);
        $newexpiration = date('Y-m-d', $time);

        $domain = Domain::findOrFail($id);
        if ($domain->userisOwner()) {
          $domain->update([
            'domain' => $request->domain,
            'pa' => $request->pa,
            'da' => $request->da,
            'expiration' => $newexpiration,
            'nameserver1' => $request->nameserver1,
            'nameserver2' => $request->nameserver2,
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

    private function getStringBetween($string, $start, $end){
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }



    private function getStatusIndex($domaing)
    {
        $client = new Client();
        $url = 'https://www.google.com/search?q=site:'.$domaing.'&tbm=isch&sout=1';
        $res = $client->request('GET', $url);
        $hasil = $res->getBody();

        $index = self::getStringBetween($hasil, '<div class="sd" id="resultStats">Sekitar ', ' hasil</div>');
        if ($index == '') {
            $indexStatus = 'No';
        } else {
            $indexStatus = 'Yes';
        }
        return $indexStatus;
    }

    public function refreshStatusIndex($domaing){
        $statusIndex = self::getStatusIndex($domaing);

        $domain = Domain::where('domain', $domaing)->first();
        $domain->update([
            'index_status' => $statusIndex,
        ]);

        return $statusIndex;
    }
    
    private function getDomainProperty($domain){
        $client = new Client();
        $url = 'https://www.whois.com/whois/'.$domain;
        $res = $client->request('GET', $url, ['headers' => ['User-Agent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36']]);
        $hasil = $res->getBody();
        
        $expiration = self::getStringBetween($hasil, 'Expires On:</div><div class="df-value">', '</div>');
        $nameserver1 = self::getStringBetween($hasil, 'Name Servers:</div><div class="df-value">', '<br>');
        $nameserver2 = self::getStringBetween($hasil, 'Name Servers:</div><div class="df-value">'.$nameserver1.'<br>', '</div>');
        $result = array("expiration"=>$expiration, "nameserver1"=>$nameserver1, "nameserver2"=>$nameserver2);

        return $result;
    }

    public function refreshExpiration($domain){
        $property = self::getDomainProperty($domain);
        $expiration = $property["expiration"];
        $domain = Domain::where('domain', $domain)->first();
        $domain->update([
            'expiration' => $expiration,
        ]);

        return $expiration;
    }

    public function refreshNameServer1($domain){
        $property = self::getDomainProperty($domain);
        $nameserver1 = $property["nameserver1"];
        $domain = Domain::where('domain', $domain)->first();
        $domain->update([
            'nameserver1' => $nameserver1,
        ]);
        
        return response()->json([
            'nameserver1' => $nameserver1,
        ]);
    }

    public function refreshNameServer2($domain){
        $property = self::getDomainProperty($domain);
        $nameserver2 = $property["nameserver2"];
    
        $domain = Domain::where('domain', $domain)->first();
        $domain->update([
            'nameserver2' => $nameserver2,
        ]);
        
        return response()->json([
            'nameserver2' => $nameserver2,
        ]);
    }

}
