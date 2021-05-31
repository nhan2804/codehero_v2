<?php

namespace App\Http\Controllers\Mobi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Session;
use Carbon\Carbon;
use App\Forum;
use App\Admin;
use App\Comment;
use App\CateForum;
use App\React;
use App\Notification;
class ForumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $forum =  DB::table('forum')->selectRaw('forum.img,id_auth_cmt,user,title_post,forum.created_at,avatar,forum.id_post,like_post,comments,views,accounts.id,displayname,content_post')->Join('accounts','forum.auth_post','=','accounts.id')
            ->leftJoin('react',function($j)
            {
                $id_user = session('id') or null;
                $j->on('forum.id_post', '=', 'react.id_post')->
                where('react.id_auth_cmt',$id_user);
            })
            ->groupBy('forum.id_post')
            ->orderBy('forum.created_at','DESC')->paginate(5);
            return $forum;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $data = new Forum;
    $title_post= $req->title;
    $slug_forum= "slug";
    $content_post= $req->content;
    $cate_forum= $req->cate;
   
    $auth_post = $req->session()->get('id');
    $data->title_post= $title_post;
    $data->slug_forum= $slug_forum;
    $data->content_post= $content_post;
    $data->auth_post= $auth_post;
      $data->bgcolor= '';
      $data->like_post= 0;
      $data->views= 0;
       $data->img= $req->url;
      $data->comments= 0;

      $data->id_cate_forum= 12;
    try {
        $data->save();
        return response()->json(["message"=>"Tạo bài viết thành công","id"=>$data->id_post],200);
    } catch (Exception $e) {
         return response()->json(["message"=>"Có lỗi sảy ra, vui lòng thử lại"],405);
       
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $req)
    {
        $id_auth= $req->session()->get('id') or null;
      $user = Admin::find($id_auth) or null;
      $data = DB::table('forum')->selectRaw('forum.img,forum.auth_post,id_auth_cmt,user,title_post,forum.created_at,avatar,forum.id_post,like_post,comments,views,accounts.id,displayname,content_post')->Join('accounts','forum.auth_post','=','accounts.id')
            ->leftJoin('react',function($j)
            {
                $id_user = session('id') or null;
                $j->on('forum.id_post', '=', 'react.id_post')->
                where('react.id_auth_cmt',$id_user);
            })->where('forum.id_post',$id)->first();
     
      $allcmt = DB::table('cmt')->selectRaw('cmt.*,accounts.*,react.id_auth_cmt,react.id as id_r')
      ->leftJoin('react',function ($j) use($id_auth,$id)
      {
        $j->on('react.id_cmt','cmt.id_cmt')
        ->where('react.id_auth_cmt',$id_auth);
      })
      ->join('accounts','accounts.id','=','cmt.id_auth')
      ->where('id_forum',$id)->where('id_parent',0)->paginate(20);

      // $cmt_child = DB::table('accounts')->join('cmt','accounts.id','=','cmt.id_auth')->where('id_forum',$id)->where('id_parent','!=',0)->get();

      $forum_view = 'forum_'.$id;
      $update= Forum::find($id);
      if (!Session::has($forum_view)) {
         $update->views=$update->views+1;
         $update->save();
         Session::put($forum_view,1);
      }
      $arr = [ 
          
         'datas' => $data,
         // 'cmt_child'=>$cmt_child,
         'allcmt'=> $allcmt,
         
      ];
    return response()->json($arr);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
