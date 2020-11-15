<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Comment extends Model
{
    protected $table= "cmt";
    protected $primaryKey = "id_cmt";
    public function getTime()
    {
    	Carbon::setLocale('vi');
    	$this->created_at->diffForHumans(Carbon::now());
    }
    public function cmt()
    {
    	return $this->belongsTo('App\Admin','id_auth');
    }
}
