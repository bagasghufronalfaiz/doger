<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    protected $fillable = [
        'domain_id', 'theme', 'index_web', 'index_image', 'tool', 'keyword', 'server_id', 'server_folder', 'ad_id', 'webmaster_id', 'date', 'user_id', 'slug', 'wp_posts', 'wp_pages', 'wp_page_titles', 'wp_categories', 'wp_category_titles'
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

    public function webmaster()
    {
        return $this->belongsTo('App\Models\Webmaster');
    }
}
