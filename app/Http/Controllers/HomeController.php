<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\Domain;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = User::findOrFail(Auth::user()->id);
        return view('profile.index', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail(Auth::user()->id);
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'name'      => $request->name,
            'email'     => $request->email,
        ]);
        return redirect('/home');
    }

}
