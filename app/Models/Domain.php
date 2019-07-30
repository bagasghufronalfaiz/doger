<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    protected $fillable = [
        'domain', 'pa', 'da', 'users_id', 'expiration', 'nameserver1', 'nameserver2', 'index_status', 'registrars_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function userisOwner()
    {
      return Auth::user()->id == $this->user->id;
    }

    public function registrar()
    {
        return $this->belongsTo('App\Models\Registrar');
    }
}
