<?php

namespace App\Models;

use Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function domains()
    {
        return $this->hasMany('App\Models\Domain');
    }

    public function registrars()
    {
        return $this->hasMany('App\Models\Registrar');
    }

    public function servers()
    {
        return $this->hasMany('App\Models\Server');
    }

    public function ads()
    {
        return $this->hasMany('App\Models\Ad');
    }

    public function websites()
    {
        return $this->hasMany('App\Models\Website');
    }

    public function webmasters()
    {
        return $this->hasMany('App\Models\Webmaster');
    }
}
