<?php

namespace App\Http\Controllers\Mobi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rate;
use DB;
use Session;
class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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
    public function store(Request $r)
    {
        $d = new Rate;
        $d->id_course=$r->id;
        $d->id_auth=Session::get('id');
        $d->comment=$r->text;
        $d->star_rate=$r->num_rate;
        $d->save();
        return response()->json($r->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rate = Rate::select('star_rate',
                   DB::raw('count(star_rate) as total'))->where('id_course',$id)->groupBy('star_rate')->get();
        $arr = [];
        foreach ($rate as $key => $v) {
            $arr[$v->star_rate]=$v;
        }
        $avg = Rate::where('id_course',$id)->avg('star_rate');
        $rated = Rate::where('id_course',$id)->with(['user'])->where('id_auth',Session::get('id'))->first();
        $rates = Rate::where('id_course',$id)->with(['user'])->orderBy('created_at','DESC')->get();
        return response()->json(['rated'=>$rated,'count'=>$arr,'rates'=>$rates,'avg'=>round($avg,1)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $r, $id)
    {
        $d = Rate::find($id);
        $d->comment=$r->text;
        $d->star_rate=$r->num_rate;
        $d->save();
        return response()->json($r->id);
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
