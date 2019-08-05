<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    $fillable = [
        'adnetwork', 'email', 'name', 'code', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function userisOwner()
    {
      return Auth::user()->id == $this->user->id;
    }
}
