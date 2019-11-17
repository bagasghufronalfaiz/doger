<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\Server;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = User::findOrFail(Auth::user()->id);

        return view('server.index', compact('user'));
    }

    public function create()
    {
        return view('server.create');
    }

    public function store(Request $request)
    {
        $invoiceDate = $request->invoiceDate;
        $time = strtotime($invoiceDate);
        $newInvoiceDate = date('Y-m-d', $time);

        $server = Server::create([
            'seller'        => $request->seller,
            'name'          => $request->name,
            'location'      => $request->location,
            'ip'            => $request->ip,
            'username'      => $request->username,
            'password'      => $request->password,
            'price'         => $request->price,
            'invoice_date'  => $newInvoiceDate,
            'user_id'       => Auth::user()->id,
        ]);

        return redirect('server');
    }

    public function edit($id)
    {
        $server = Server::findOrFail($id);

        $date = $server->invoice_date;
        $time = strtotime($date);
        $newDate = date('m/d/Y', $time);

        if($server->userisOwner()){
            return view('server.edit', compact('server', 'newDate'));
        } else {
            abort(403);
        }

    }

    public function update(Request $request, $id)
    {
        $invoiceDate = $request->invoiceDate;
        $time = strtotime($invoiceDate);
        $newInvoiceDate = date('Y-m-d', $time);

        $server = Server::findOrFail($id);
        if($server->userisOwner()){
            $server->update([
                'seller'        => $request->seller,
                'name'          => $request->name,
                'location'      => $request->location,
                'ip'            => $request->ip,
                'username'      => $request->username,
                'password'      => $request->password,
                'price'         => $request->price,
                'invoice_date'  => $newInvoiceDate
            ]);
        } else {
            abort(403);
        }

        return redirect('server');
    }

    public function destroy($id)
    {
        $server = Server::findOrFail($id);
        if ($server->userisOwner()) {
            $server->delete();
        } else {
            abort(403);
        }

        return redirect('server');
    }
}
