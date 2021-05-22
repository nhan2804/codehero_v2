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
class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
         $html_img='';
          $id_auth= Session::get('id');
           $data = new Comment;
           $get_img = $html_img!='' ? $html_img:'';
           $data->content_cmt=$req->content;
           $data->id_blog=0;
           $data->id_forum=$req->id_post;
           $data->id_parent=0;
           $data->num_cmt=0;
           $data->id_auth=$id_auth;
           $data->save();
           $id_insert = DB::getPdo()->lastInsertId();
          // $cmt_add = Comment::find($id_insert);
          $notify = new Notification;
           $notify->content_notify='đã bình luận về bài viết của bạn';
           // if($id_auth=!$req->get('id_auth_rec')) {
           $notify->id_send=$id_auth;
           $notify->id_rec=$req->id_rec;
           $notify->id_forum=$req->id_post;
           $notify->id_blog=0;
           $notify->id_cmt=0;
           $notify->type_notify=1;
           $notify->status_notify=0;
           $notify->link_notify='';
           $notify->save();
           
           return response()->json(["message"=>"Done"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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