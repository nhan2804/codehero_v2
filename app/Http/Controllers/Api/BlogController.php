<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Blog;
use DB;
use Session;
class BlogController extends Controller
{
    public function index()
    {
    	$data = DB::table('blog_cate')->join('blog','blog_cate.id','=','blog.cate_parent')->where('stt_blog','0')->orderBy('view_blog', 'DESC')->take(13)->get();
        $blog_new = DB::table('blog_cate')->join('blog','blog_cate.id','=','blog.cate_parent')->where('stt_blog','0')->orderBy('blog.created_at', 'DESC')->skip(0)->take(5)->get();
        $arr=[
        	'datas'=>$data,
        	'blog_new'=>$blog_new
        ];
    	return response()->json($arr);
    }
    public function view($id)
    {
    	$data= DB::table("blog")->join('accounts','blog.auth','=','accounts.id')->where('id_blog',$id)->first();
        $id_auth= $data->auth;
        $tags= $data->tag_blog;
        $blog_view = 'blog_'.$id;
          if (!Session::has($blog_view)) {
            $update= Blog::find($id);
             $update->view_blog=$update->view_blog+1;
             $update->save();
             Session::put($blog_view,1);
          }
        $refer_blog = Blog::where('auth',$id_auth)->where('id_blog','!=',$data->id_blog)->take(5)->get();
        $next_blog = Blog::where('tag_blog','LIKE',"%{$tags}%")->where('id_blog','!=',$data->id_blog)->take(5)->get();
    	$allcmt = DB::table('cmt')->join('accounts','accounts.id','=','cmt.id_auth')->where('id_blog',$id)->get();
        $arr= [
            'data'=>$data,
            'cmts'=>$allcmt,
            'refer_blog'=>$refer_blog,
            'next_blog'=> $next_blog
        ];
    	return response()->json($arr);
    }
}
