<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Domain;
use App\Models\User;
use App\Models\Registrar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegistrarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = User::findOrFail(Auth::user()->id);
        return view('registrar.index', compact('user'));
    }

    public function create()
    {
        return view('registrar.create');
    }

    public function store(Request $request)
    {
        $registrar = Registrar::create([
            'registrar' => $request->registrar,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password,
            'user_id' => Auth::user()->id,
        ]);

        return redirect('registrar');
    }

    public function edit($id)
    {
        $registrar = Registrar::findOrFail($id);
        if($registrar->userisOwner()){
            return view('registrar.edit', compact('registrar'));
        } else {
            abort(403);
        }
    }

    public function update(Request $request, $id)
    {
        $registrar = Registrar::findOrFail($id);
        if ($registrar->userisOwner()) {
          $registrar->update([
            'registrar' => $request->registrar,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password
          ]);
        }else {
          abort(403);
        }

        return redirect('registrar');
    }

    public function destroy($id)
    {
        $registrar = Registrar::findOrFail($id);
        if ($registrar->userisOwner()) {
            $registrar->delete();
        }else {
            abort(403);
        }

        return redirect('registrar');
    }
}
