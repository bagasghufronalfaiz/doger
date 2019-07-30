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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $user = User::findOrFail(Auth::user()->id);
        return view('registrar.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('registrar.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Registrar  $registrar
     * @return \Illuminate\Http\Response
     */
    public function show(Registrar $registrar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Registrar  $registrar
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $registrar = Registrar::findOrFail($id);
        if($registrar->userisOwner()){
            return view('registrar.edit', compact('registrar'));
        } else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Registrar  $registrar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $registrar = Registrar::findOrFail($id);
        if ($registrar->userisOwner()) {
          $registrar->update([
            'registrar' => $request->registrar,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password,
            'user_id' => Auth::user()->id,
          ]);
        }else {
          abort(403);
        }

        return redirect('registrar')->with('msg', 'registrar  berhasil di edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Registrar  $registrar
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $registrar = Registrar::findOrFail($id);
        // dd($domain->userisOwner());
        if ($registrar->userisOwner()) {
            $registrar->delete();
        }else {
            abort(403);
        }

        return redirect('registrar')->with('msg', 'registrar  berhasil di hapus');
    }
}
