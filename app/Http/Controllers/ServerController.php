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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::findOrFail(Auth::user()->id);

        return view('server.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('server.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $invoice_date = $request->invoice_date;
        $time = strtotime($invoice_date);
        $newinvoice_date = date('Y-m-d', $time);

        $server = Server::create([
            'seller'        => $request->seller,
            'servername'    => $request->servername,
            'location'      => $request->location,
            'ip'            => $request->ip,
            'username'      => $request->username,
            'password'      => $request->password,
            'price'         => $request->price,
            'invoice_date'  => $newinvoice_date,
            'user_id'       => Auth::user()->id,
        ]);

        return redirect('server');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $server = Server::findOrFail($id);

        $date = $server->invoice_date;
        $time = strtotime($date);
        $newdate = date('m/d/Y', $time);

        if($server->userisOwner()){
            return view('server.edit', compact('server', 'newdate'));
        } else {
            abort(403);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $invoice_date = $request->invoice_date;
        $time = strtotime($invoice_date);
        $newinvoice_date = date('Y-m-d', $time);

        $server = Server::findOrFail($id);
        if($server->userisOwner()){
            $server->update([
                'seller'        => $request->seller,
                'servername'    => $request->servername,
                'location'      => $request->location,
                'ip'            => $request->ip,
                'username'      => $request->username,
                'password'      => $request->password,
                'price'         => $request->price,
                'invoice_date'  => $newinvoice_date
            ]);
        } else {
            abort(403);
        }

        return redirect('server');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
