<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Webmaster extends Model
{
    protected $fillable = [
        'email', 'name', 'user_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function userisOwner()
    {
        return Auth::user()->id == $this->user->id;
    }

    public function websites()
    {
        return $this->hasMany('App\Models\Website');
    }


}
