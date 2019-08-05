<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\Ad;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }



    public function index()
    {
        $user = User::findOrFail(Auth::user()->id);

        return view('ad.index', compact('user'));
    }



    public function create()
    {
        return view('ad.create');
    }



    public function store(Request $request)
    {
        $ad = Ad::create([
            'adnetwork' => $request->adnetwork, 
            'email'     => $request->email,
            'name'      => $request->name, 
            'code'      => $request->code,
            'user_id'   => Auth::user()->id,
        ]);

        return redirect('ad');
    }



    public function show($id)
    {
        //
    }



    public function edit($id)
    {
        $ad = Ad::findOrFail($id);
        if($ad->userisOwner()){
            return view('ad.edit', compact('ad'));
        } else {
            abort(403);
        }
    }

    
    
    public function update(Request $request, $id)
    {
        $ad = Ad::findOrFail($id);
        if($ad->userisOwner()){
            $ad->update([
                'adnetwork' => $request->adnetwork, 
                'email'     => $request->email,
                'name'      => $request->name, 
                'code'      => $request->code
            ]);
        } else {
            abort(403);
        }

        return redirect('ad');
    }

    
    
    public function destroy($id)
    {
        $ad = Ad::findOrFail($id);
        if ($ad->userisOwner()) {
            $ad->delete();
        } else {
            abort(403);
        }

        return redirect('ad');
    }
}
