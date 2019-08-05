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
        $server = Server::create([
            'seller'        => $request->seller,
            'servername'    => $request->servername,
            'location'      => $request->location,
            'ip'            => $request->ip,
            'username'      => $request->username,
            'password'      => $request->password,
            'price'         => $request->price,
            'invoice_date'  => $request->invoice_date,
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
        if($server->userisOwner()){
            return view('server.edit', compact('server'));
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
                'invoice_date'  => $request->invoice_date,
                'user_id'       => Auth::user()->id,
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
        // dd($domain->userisOwner());
        if ($server->userisOwner()) {
            $server->delete();
        } else {
            abort(403);
        }

        return redirect('server');
    }
}
