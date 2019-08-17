<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\Website;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check())
        {
            $user = User::findOrFail(Auth::user()->id);
            return view('welcome', compact('user'));
        } else {
            
            return view('welcome-copy');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::findOrFail(Auth::user()->id);
        return view('website.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $website = Website::create([
            'domain_id' => $request->domain,
            'theme' => $request->theme,
            'index' => $request->index,
            'keyword' => $request->keyword,
            'server_id' => $request->servercok,
            'server_folder' => $request->server_folder,
            'ad_id' => $request->ad,
            'date' => $request->date,
            'webmaster' => $request->webmaster,
            'user_id' => Auth::user()->id,
        ]);

        return redirect('/');
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
        $website = Website::findOrFail($id);
        if($website->userisOwner()){
            $user = User::findOrFail(Auth::user()->id);
            return view('website.edit', compact('website', 'user'));
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
        $website = Website::findOrFail($id);
        if ($website->userisOwner()) {
          $website->update([
            'domain_id' => $request->domain,
            'theme' => $request->theme,
            'index' => $request->index,
            'keyword' => $request->keyword,
            'server_id' => $request->servercok,
            'server_folder' => $request->server_folder,
            'ad_id' => $request->ad,
            'date' => $request->date,
            'webmaster' => $request->webmaster
          ]);
        }else {
          abort(403);
        }

        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $website = Website::findOrFail($id);
        if ($website->userisOwner()) {
            $website->delete();
        }else {
            abort(403);
        }

        return redirect('/');
    }
}
