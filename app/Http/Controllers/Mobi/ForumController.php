<?php

namespace App\Http\Controllers\Mobi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Forum;
class ForumController extends Controller
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
