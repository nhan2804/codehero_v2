<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Session;
use App\Course;
use App\CateCourse;
use App\Admin;
use App\Account_Course;
use App\Notification;
class CourseController extends Controller
{
   public function index()
   {
   	$data = DB::table('course_cate')->join('course','course_cate.id_cate','=','course.cate_parent')->orderByDesc('course_cate.id_cate')->get();
   	return response()->json($data);
   }
   public function category($id)
   {
     $data = DB::table('course_cate')->join('course','course_cate.id_cate','=','course.cate_parent')->where('id_cate',$id)->get();
     $cate = CateCourse::where('id_cate',$id)->first();
     $arr = [
      'datas'=>$data,
      'cate'=>$cate
     ];
     return response()->json($arr);
   }
   public function view($id)
   {
   	$data =Course::find($id);
        if (!$data) {
         return view('errors.404');
      }
        $total_star= DB::table('course')->join('rate','course.id_course','=','rate.id_course')->where('rate.id_course','=',$id)->avg('rate.star_rate');
        if ($total_star==0) {
            $total_star=5;
        }else{
            $total_star= substr($total_star, 0,3);
        }
        $id_user= session('id') or null;
        $user = Admin::find($id_user);
         $lesson =DB::table('lesson')->where('course_parent',$id)->get();
        if ($id_user) {
            
            $rs = DB::table("accounts")->join('account_course','accounts.id','=','account_course.id_user')->where('account_course.id_course',$id)->where('accounts.id',$id_user)->count();
            if ($rs) {
               
                 return response()->json(['bought'=>$rs,'lessons'=>$lesson,'total_star'=>$total_star,'course_detail'=>$data,'user'=>$user]);
            }else{
                return response()->json(['lessons'=>$lesson,'total_star'=>$total_star,'course_detail'=>$data,'user'=>$user]);
            }
        }else{
            return response()->json(['lessons'=>$lesson,'total_star'=>$total_star,'course_detail'=>$data,'user'=>$user]);
        }
   }
   public function buy_course(Request $req)
   {
    // return response()->json(['message'=>$req->all()],200);
     if ($req->get("id")) {
            if ($req->session()->get('id')) {
            $id_user = $req->session()->get('id');
            $id_course=$req->get("id");
            if (is_numeric($id_course)) {
                $rs= Course::find($id_course);
                if (isset($rs['id_course'])) {
                    $coin_course= $rs['coin'];
                    $user= Admin::find($id_user);
                    $coin_user = $user['coin'];
                    if ($coin_user>=$coin_course) {
                        $data = new Account_Course;
                        $data->id_user=$id_user;
                        $data->id_course=$id_course;
                        $data->coin=$coin_course;
                        $data->save();
                        $coin_current = $coin_user-$coin_course;
                        $user->coin=$coin_current;
                        $user->save();

                        $notify = new Notification;
                        $notify->content_notify='Mua thành công khóa học';
                        $notify->id_send=0;
                        $notify->id_rec=$id_user;
                        $notify->id_forum=0;
                        $notify->id_blog=0;
                        $notify->id_cmt=0;
                        $notify->type_notify=3;
                        $notify->status_notify=0;
                        $notify->link_notify='link';
                        $notify->save();
                        return response()->json(['message'=>"Đã mua thành công!"],200);
                        
                    }else{
                      return response()->json(['message'=>"Không đủ tiền, vui lòng nạp thêm!"],405);
                        
                    }
                }else{
                  return response()->json(['message'=>"Có lỗi xảy ra,vui lòng thử lại(1)!"],405);
                   
                }
            }else{
              return response()->json(['message'=>"Có lỗi xảy ra,vui lòng thử lại!"],405);
               
            }
        }
        }else{
          return response()->json(['message'=>"Có lỗi xảy ra,vui lòng thử lại!2"],405);
        }
   }

}
