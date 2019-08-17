<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    protected $fillable = [
        'seller', 'location', 'servername', 'ip', 'username', 'password', 'price', 'invoice_date', 'user_id'
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
