<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table= "accounts";
    protected $keyPrimary= "id";
    public function posts()
    {
        return $this->hasMany('App\Forum');
    }
    public function cmt()
    {
    	return $this->hasMany('App\Comment','id_auth');
    }
}
