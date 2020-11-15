<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use App\CateCourse;
use App\Course;
use App\Lesson;
use App\Account_Course;
use App\Admin;
use App\Rate;
use App\Notification;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
   public function index()
    {
       return view("page.home");
    }
    public function course()
    {
    	$data = DB::table('course_cate')->join('course','course_cate.id_cate','=','course.cate_parent')->orderByDesc('course_cate.id_cate')->get();

    	return view("page.course_home")->with("course",$data);
    }
    public function cate_course($id)
    {
        $data = DB::table('course_cate')->join('course','course_cate.id_cate','=','course.cate_parent')->where('course_cate.id_cate',$id)->get();
        return view("page.course_home")->with("course_cate",$data);
    }
    public function rate_course(Request $req)
    {
        if ($req->get("id_course") && $req->get("rate") && $req->get("star_rate")) {
           $data = new Rate;
           $data->id_course=$req->get("id_course");
           $data->id_auth=$req->session()->get('id');
           $data->star_rate=$req->get("star_rate")+1;
           $data->comment=$req->get("rate");
           $data->save();

        }
        echo "string";
    }
    public function rate_detail(Request $req)
    {
        $html='';
        if ($req->get("id_course")) {
            $data = DB::table('rate')->join('accounts','rate.id_auth','=','accounts.id')->where('rate.id_course','=',$req->get("id_course"))->get();
            foreach ($data as $key => $value) {
                $num_star= $value->star_rate;
                $url = asset($value->avatar);
                $star='';
                for ($i=1; $i <=5; $i++) { 
                    if ($i<=$num_star) {
                            $star.= '<i style="color:green" class="fa fa-star icon-smail"></i>';
                        }else{
                            $star.= '<i style="color:#C0C0C0" class="fa fa-star icon-smail"></i>';
                        }
                }
                $html.='<li>
                        <div class="info_rate">
                            <img class="img_rate" alt="loi" src="'.$url.'">
                            <div>
                                <p class="name_rate">'.$value->displayname.'</p>
                                <span>'.$star.'</span><span>  '.$value->created_at.'</span>
                            </div>
                        </div>
                        <p>'.$value->comment.'</p>
                        </li>';
            }

        }
        echo $html;
    }
    public function course_detail($id)
    {
        $data =Course::find($id)->toArray();
        if (!$data) {
         return view('errors.404');
      }
        $total_star= DB::table('course')->join('rate','course.id_course','=','rate.id_course')->where('rate.id_course','=',$id)->avg('rate.star_rate');

        if ($total_star==0) {
            $total_star=5;
        }else{
            $total_star= substr($total_star, 0,3);
        }
        if (session('id')) {
            $id_user= session('id');
            $rs = DB::table("accounts")->join('account_course','accounts.id','=','account_course.id_user')->where('account_course.id_course',$id)->where('accounts.id',$id_user)->get();
            if (count($rs)) {
                $lesson =DB::table('lesson')->where('course_parent',$id)->get();
                return view("page.course_detail",['bought'=>$rs,'lessons'=>$lesson,'total_star'=>$total_star,'course_detail'=>$data]);  
            }else{
                return view("page.course_detail",['total_star'=>$total_star,'course_detail'=>$data]); 
            }
        }else{
            return view("page.course_detail",['total_star'=>$total_star,'course_detail'=>$data]);  
        }
    }
    public function buy_course(Request $req)
    {
        if ($req->get("id_course")) {
            if ($req->session()->get('id')) {
            $id_user = $req->session()->get('id');
            $id_course=$req->get("id_course");
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
                        $notify->content_notify='Mua thành công khóa học <span class="name_user_notify">'.$req->get('title_web').'</span>';
                        $notify->id_send=0;
                        $notify->id_rec=$id_user;
                        $notify->id_forum=0;
                        $notify->id_blog=0;
                        $notify->id_cmt=0;
                        $notify->type_notify=3;
                        $notify->status_notify=0;
                        $notify->link_notify=$req->get('link_url');
                        $notify->save();
                        Session::put("coin",$coin_current);
                        echo '<span style="color:green">Đã mua thành công!</span>';
                        echo '<script>
                        location.reload();
                            </script>';
                    }else{
                        echo '<span style="color:yellow">Không đủ tiền, vui lòng nạp thêm!</span>';
                    }
                }else{
                    echo '<span style="color:red">Có lỗi xảy ra,vui lòng thử lại(1)!</span>';
                }
            }else{
                echo '<span style="color:red">Có lỗi xảy ra,vui lòng thử lại!</span>';
            }
        }else{
        echo '<script>
        $(".btn_modal").click();
        </script>';
            }
        }
    }
}
