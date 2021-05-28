<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Blog;
class ProfileController extends Controller
{
    public function my()
    {
        $id_user = session('id');
        
        return response()->json(Admin::find($id_user));   
    }
    public function course()
    {
    	$id_user = session('id');
    	$rs = DB::table("accounts")->select('course.*')->join('account_course','accounts.id','=','account_course.id_user')->join('course','account_course.id_course','=','course.id_course')->where('accounts.id',$id_user)->get();
    	return response()->json($rs);	
    }
    public function blog(Request $req)
    {
        $id_user = session('id');
        $rs = DB::table("accounts")->select('accounts.*','blog.title_blog','blog.id_blog','blog.img_blog')->join('blog','accounts.id','=','blog.auth')->where('auth',$id_user)->get();
       // $data = Blog::where('auth',$id_user)->get();
       return response()->json($rs);	
    }
}
