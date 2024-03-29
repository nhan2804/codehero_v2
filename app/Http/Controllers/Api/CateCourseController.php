<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Session;
use App\Course;
use App\CateCourse;
use App\Admin;
class CateCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $r)
    {
        $query = $r->input('query');
        $arr = array();
        $data;
        if($query){
            $data = DB::table('course_cate')->join('course','course_cate.id_cate','=','course.cate_parent')->where('title_course','LIKE','%'.$query.'%')->orderByDesc('course_cate.id_cate')->get();
        
        }else{
            $data = DB::table('course_cate')->join('course','course_cate.id_cate','=','course.cate_parent')->orderByDesc('course_cate.id_cate')->get();
      
        
        }
        foreach ($data as $key => $v) {
          $arr[$v->name][] =$v;
        }
   
       $cate =  CateCourse::all();
        return response()->json(['cate'=>$cate,'courses'=>$arr]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function suggest()
    {
        return response()->json(Course::all());
    }
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
    public function store(Request $request)
    {
        //
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
