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

    public function index()
    {
        $user = User::findOrFail(Auth::user()->id);
        return view('webmaster.index', compact('user'));
    }

    public function create()
    {
        $user = User::findOrFail(Auth::user()->id);
        return view('webmaster.create', compact('user'));
    }

    public function store(Request $request)
    {
        $webmaster = Webmaster::create([
            'name'      => $request->name,            
            'email'     => $request->email,            
            'user_id'   => Auth::user()->id,
        ]);

        return redirect('webmaster');
    }

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
