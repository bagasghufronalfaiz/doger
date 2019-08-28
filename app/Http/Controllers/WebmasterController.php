<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\Webmaster;
use Illuminate\Http\Request;

class WebmasterController extends Controller
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

        return view('webmaster.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::findOrFail(Auth::user()->id);
        return view('webmaster.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $webmaster = Webmaster::create([
            'name'      => $request->name,            
            'email'     => $request->email,            
            'user_id'   => Auth::user()->id,
        ]);

        return redirect('webmaster');
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
        $webmaster = Webmaster::findOrFail($id);
        if($webmaster->userisOwner()){
            $user = User::findOrFail(Auth::user()->id);
            return view('webmaster.edit', compact('webmaster', 'user'));
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
        $webmaster = Webmaster::findOrFail($id);
        if ($webmaster->userisOwner()) {
          $webmaster->update([
            'name' => $request->name,
            'email' => $request->email,            
          ]);
        }else {
          abort(403);
        }

        return redirect('webmaster');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $webmaster = Webmaster::findOrFail($id);
        if ($webmaster->userisOwner()) {
            $webmaster->delete();
        } else {
            abort(403);
        }

        return redirect('webmaster');
    }
}
