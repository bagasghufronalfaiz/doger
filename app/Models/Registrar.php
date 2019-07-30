<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Registrar extends Model
{
    protected $fillable = [
        'registrar', 'username', 'email', 'password'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function userisOwner()
    {
        return Auth::user()->id == $this->user->id;
    }

    public function domains()
    {
        return $this->hasMany('App\Models\Domain');
    }

}
