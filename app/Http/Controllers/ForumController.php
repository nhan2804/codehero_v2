<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Blog;
use App\Comment;
use App\CateCourse;
use App\Admin;
use Session;
use Carbon\Carbon;
class ForumController extends Controller
{
    public function index()
    {
        $data = DB::table('blog_cate')->join('blog','blog_cate.id','=','blog.cate_parent')->where('stt_blog','0')->orderBy('view_blog', 'DESC')->take(13)->get();
        $blog_new = DB::table('blog_cate')->join('blog','blog_cate.id','=','blog.cate_parent')->where('stt_blog','0')->orderBy('blog.created_at', 'DESC')->skip(0)->take(5)->get();
    	return view('admin.forum')->with('data',$data)->with('blog_new',$blog_new); 
    }
    public function view_post($id)
    {
        $data= DB::table("blog")->join('accounts','blog.auth','=','accounts.id')->where('id_blog',$id)->first();
        if (!$data) {
         return view('errors.404');
      }
        $id_auth= $data->auth;
        $tags= $data->tag_blog;
        $blog_view = 'blog_'.$id;
          if (!Session::has($blog_view)) {
            $update= Blog::find($id);
             $update->view_blog=$update->view_blog+1;
             $update->save();
             Session::put($blog_view,1);
          }
    	// $allcmt= Comment::all()->where('id_blog',$id)->toArray();
        // $allcmt= Comment::with('cmt')->join('accounts','accounts.id','=','cmt.auth_cmt')->where('id_blog',$id)->get("accounts.displayname","cmt.*");
        $refer_blog = Blog::where('auth',$id_auth)->where('id_blog','!=',$data->id_blog)->take(5)->get();
        $next_blog = Blog::where('tag_blog','LIKE',"%{$tags}%")->where('id_blog','!=',$data->id_blog)->take(5)->get();
    	$allcmt = DB::table('cmt')->join('accounts','accounts.id','=','cmt.id_auth')->where('id_blog',$id)->get();
        $arr= [
            'data'=>$data,
            'cmts'=>$allcmt,
            'refer_blog'=>$refer_blog,
            'next_blog'=> $next_blog
        ];
    	return view('page.view_blog',$arr);
    }
    public function search_post(Request $req)
    {
    	if ($req->get('search')) {
    		$html="";
    		$s =$req->get('search');
    		$data = DB::table('blog')->where('title_blog','LIKE',"%{$s}%")->get();
            if (count($data)) {
    		foreach($data as $key => $value) {
            $img= "public".$value->img_blog;
            $str = $value->title_blog;
            if (strlen($str) > 40){
                $str = substr($str, 0, 40);
            }
            $time =substr($value->created_at,0,10);
            $html.='
            <li class="item_popular">
                <a class="link_popular" href="/codehero/forum/post/'.$value->id_blog.'">
                    <div class="popular">
                        <img class="img_popular" src="'.$img.'" alt="ns">
                        <div class="desc_popular">
                            <span class="title_popular">
                                '.$str.'
                            </span>
                            <span class="time_popular">
                               '.$time.'
                            </span>
                        </div>
                    </div>
                </a>
            </li>
            ';
    		}
            echo $html;
        }else{
    		echo '<p style="text-align: center;margin-bottom:0;padding:8px 0;">Không tìm thấy kết quả</p>';
        }
    	}
    }
    public function cmt_blog(Request $req)
    {
    	if ($req->get('cmt') && $req->get('id_blog')) {
    		$html="";
    		$cmt=$req->get('cmt');
    		$id_auth = session()->get('id');
            $id_blog =$req->get('id_blog');
            
            $user = Admin::find($id_auth);
    		$data = new Comment;
    		$data->content_cmt=$cmt;
    		$data->id_blog=$id_blog;
    		$data->id_forum=0;
    		$data->id_parent=0;
    		$data->id_auth=$id_auth;
    		$data->save();
    		$html='
            <div class="div_comment" style="margin: 20px 0;">
            <div class="info_cmt">
                <img class="img_cmt" src="http://localhost/codehero'.$img_auth.'" alt="">
                <h3 class="name_auth">'.$name.'</h3>
            </div>
            <span class="content_cmt">'.$cmt.'</span>
            <div>
                <a href="#" style="margin-right: 8px">Trả lời</a>
                <a href="#">Thích</a>
            </div>
            </div>
            ';
            // echo $html;
            echo $user;
    	}else{
            echo "false";
        }
    }
    public function see_more(Request $req)
    {
        $html='';
        // echo "string";
        $blog_new = DB::table('blog_cate')->join('blog','blog_cate.id','=','blog.cate_parent')->orderBy('blog.created_at', 'DESC')->skip($req->row_curr)->take(5)->get();
        if (count($blog_new)) {
            foreach ($blog_new as $key => $value) {
            $time= Carbon::parse($value->created_at)->diffForHumans();
            $url = asset('public'.$value->img_blog);
            $html.= '
           <div class="row mb-3">
                <div class="col-md-5 col">
                    <div style="background:url('.$url.');background-position: center;background-size: cover; height: 180px;padding: 4px 0;"></div>
                </div>
                <div class="col-md-7 col">
                    <div>
                        <span style="background: '.$value->color_cate.'" class="blog_cate">'.$value->name.'</span>
                        <a class="item_link" href="forum/post/'.$value->id_blog.'">
                        <h3 style="color: #333;font-weight: 490;margin: 6px 0">'.$value->title_blog.'</h3>
                        </a>
                        <span style="color: #333;" class="item_date">'.$time.'</span>
                        <div class="div_conten-blog">
                            '.$value->content_blog.'
                        </div>
                    </div>
                </div>
            </div>';
            }
            echo $html;
        }else{
            echo "done";
        } 
    }
}
