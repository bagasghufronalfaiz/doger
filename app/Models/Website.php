<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    protected $fillable = [
        'domain_id', 'theme', 'index', 'keyword', 'server_id', 'server_folder', 'ad_id', 'webmaster', 'date', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function userisOwner()
    {
        return Auth::user()->id == $this->user->id;
    }

    public function domain()
    {
        return $this->belongsTo('App\Models\Domain');
    }

    public function server()
    {
        return $this->belongsTo('App\Models\Server');
    }

    public function ad()
    {
        return $this->belongsTo('App\Models\Ad');
    }
}
