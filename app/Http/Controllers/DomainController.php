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
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = User::findOrFail(Auth::user()->id);

        return view('domain.index', compact('user'));
    }

    
    public function create()
    {
        $user = User::findOrFail(Auth::user()->id);
        return view('domain.create', compact('user'));
    }

    public function store(Request $request)
    {
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

    public function update(Request $request, $id)
    {
        $domain = Domain::findOrFail($id);
        if ($domain->userisOwner()) {
          $domain->update([
            'registrar_id' => $request->registrar_id
          ]);
        }else {
          abort(403);
        }

        return redirect('domain');
    }

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

    private function getStatusIndex($domain)
    {
        $client = new Client();
        $url = 'https://www.google.com/search?q=site:'.$domain.'&tbm=isch&sout=1';
        $res = $client->request('GET', $url, ['headers' => ['User-Agent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36']]);
        $hasil = $res->getBody();

        $index = self::getStringBetween($hasil, '<font size="-1">Sekitar ', ' hasil (<b>');
        if ($index == '') {
            $indexStatus = 'No';
        } else {
            $indexStatus = 'Yes';
        }
        return $indexStatus;
    }

    public function refreshStatusIndex($domain){
        $domainDB = Domain::where('domain', $domain)->first();
        if ($domainDB->userisOwner()) {
            $statusIndex = self::getStatusIndex($domain);

            $domainDB->update([
                'index_status' => $statusIndex,
            ]);

            return response()->json([
                'status-index' => $statusIndex,
            ]);
        } else {
            $statusIndex = 'Access Denied';
            return response()->json([
                'status-index' => $statusIndex,
            ]);
        }
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
        $domainDB = Domain::where('domain', $domain)->first();
        if ($domainDB->userisOwner()) {
            $property = self::getDomainProperty($domain);
            $expiration = $property["expiration"];
            
            $domainDB->update([
                'expiration' => $expiration,
            ]);

            return response()->json([
                'expiration' => $expiration,
            ]);
        } else {
            $expiration = 'Access Denied';
            return response()->json([
                'expiration' => $expiration,
            ]);
        }
    }

    public function refreshNameServer1($domain){
        $domainDB = Domain::where('domain', $domain)->first();
        if ($domainDB->userisOwner()) {
            $property = self::getDomainProperty($domain);
            $nameserver1 = $property["nameserver1"];
            
            $domainDB->update([
                'nameserver1' => $nameserver1,
            ]);

            return response()->json([
                'nameserver1' => $nameserver1,
            ]);
        } else {
            $nameserver1 = 'Access Denied';
            return response()->json([
                'nameserver1' => $nameserver1,
            ]);
        }
    }

    public function refreshNameServer2($domain){
        $domainDB = Domain::where('domain', $domain)->first();
        if ($domainDB->userisOwner()) {
            $property = self::getDomainProperty($domain);
            $nameserver2 = $property["nameserver2"];

            $domainDB->update([
                'nameserver2' => $nameserver2,
            ]);

            return response()->json([
                'nameserver2' => $nameserver2,
            ]);
        } else {
            $nameserver2 = 'Access Denied';
            return response()->json([
                'nameserver2' => $nameserver2,
            ]);
        }          
    }

}
