<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Domain;
use App\Models\User;
use Illuminate\Http\Request;

class DomainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id = null)
    {
        $domains = Domain::all();

        if ($id == null) {
            $user = User::findOrFail(Auth::user()->id);
          } else {
            $user = User::findOrFail($id);
          }

        return view('domain.index', compact('domains','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('domain.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $domain = Domain::create([
            'domain' => $request->domain,
            'pa' => $request->pa,
            'da' => $request->da,
            'expiration' => $request->expiration,
            'nameserver1' => $request->nameserver1,
            'nameserver2' => $request->nameserver2,
            'index_status' => $request->index_status,
            'user_id' => Auth::user()->id,
        ]);

        return redirect('domain');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Domain  $domain
     * @return \Illuminate\Http\Response
     */
    public function show(Domain $domain)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Domain  $domain
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $domain = Domain::findOrFail($id);
        if($domain->userisOwner()){
            return view('domain.edit', compact('domain'));
        } else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Domain  $domain
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $domain = Domain::findOrFail($id);
        if ($domain->userisOwner()) {
          $domain->update([
            'domain' => $request->domain,
            'pa' => $request->pa,
            'da' => $request->da,
            'expiration' => $request->expiration,
            'nameserver1' => $request->nameserver1,
            'nameserver2' => $request->nameserver2,
            'index_status' => $request->index_status,
            'user_id' => Auth::user()->id,
          ]);
        }else {
          abort(403);
        }

        return redirect('domain')->with('msg', 'domain  berhasil di edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Domain  $domain
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $domain = Domain::findOrFail($id);
        // dd($domain->userisOwner());
        if ($domain->userisOwner()) {
            $domain->delete();
        }else {
            abort(403);
        }

        return redirect('domain');
    }
}
