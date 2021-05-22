<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Session;
class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Session::get("id")) {
             return response()->json(['id'=>Session::get("id")],200);
        }
       
        return response()->json(["message"=>"false"],401);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $req)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
         // return response()->json([Session::get("id")],200);
        $user = $req->username;
        $password = md5($req->password);
        $rs = DB::table('accounts')->where('user',$user)->where('password',$password)->first();
        if ($rs) {
            Session::put("id",$rs->id);
            Session::put("lv",$rs->accessright);
            Session::put("name",$rs->displayname);
            Session::put("img",$rs->avatar);
            Session::put("coin",$rs->coin);
            Session::put("vip",$rs->descript);
            return response()->json([Session::put("id",$rs->id)],200);
            
        }else{
            return response()->json(['message'=>"Thông tin tài khoản hoặc mật khẩu không chính xác, vui lòng thử lại sau"],401);
           
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
