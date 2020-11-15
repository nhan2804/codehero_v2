<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title')</title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('public/frontend/css/home.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/frontend/css/courses.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/frontend/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/frontend/css/coursesdetail.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/frontend/css/blog.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/frontend/css/blogpost.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/frontend/css/responsive.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/frontend/css/forum.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/frontend/css/document.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/frontend/css/preload.css')}}">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="{{asset('public/backend/ckeditor/ckeditor.js')}}"></script>
    
</head>
<body>
    <div id="app">
    <a href="javascript:void(0)"><div class="page"><i class="fas fa-angle-up"></i></div></a>
<div class="modal_popup_nav hidden">
    <div class="layer"></div>
    <div class="popup_nav">
       <ul class="header_list_moblie">
            <li class="header_item_mobile"><a class="header_link_mobile" href="{{URL::to('/#/course')}}">Chương trình đào tạo</a>
            </li>
            <li class="header_item_mobile"><a class="header_link_mobile" href="{{URL::to('/document')}}">Tài liệu</a>
            </li>
            <li class="header_item_mobile "><a class="header_link_mobile" href="{{URL::to('/forum')}}">Chia sẻ</a>
            </li>
            <li class="header_item_mobile "><a class="header_link_mobile" href="{{URL::to('/blog')}}">Forum</a>
            </li>
        </ul>    
    </div>
</div>
    <div class="modal_popup hidden">
        <div class="layer"></div>
        <div class="popup_login">
            <div class="header_btn">
                <button style="outline: none;" onclick="opentab(event,'signup')" class="opentab header_login btn_signup">Đăng Ký</button>
                <button style="outline: none;" id="opened"  onclick="opentab(event,'signin')" class="opentab header_login btn_signin">Đăng Nhập</button>
            </div>
            <div class="form_login">
                <div id="signin" class="input_login">
                    <form onsubmit="return false" action="{{URL::to("admin/check-login")}}" method="POST">
                        {{csrf_field()}}
                        <div class="div_input">
                            <div class="icon_login" style="">
                               <i class="fas fa-user"></i> 
                            </div>
                            <div class="div_title">
                                <h5>Username</h5>
                                <input id="input_user" class="input_item" type="text" name="user" autocomplete="off">
                            </div>
                        </div>
                        <div class="div_input">
                            <div class="icon_login" style="display: flex;align-items: center;">
                               <i class="fas fa-lock"></i> 
                            </div>
                            <div class="div_title">
                                <h5>Password</h5>
                                <input id="input_pass" class="input_item" type="password" autocomplete="off" name="password">
                            </div>
                        </div>
                        <br>
                        <input id="btn_login" class="input_item btn_reg" type="submit" value="Đăng Nhập" name="">
                    </form>
                    <div style="color: #E9E342" class="check_login"></div>
                        <p style="text-align: center;">Hoặc sử dụng tài khoản khác</p>
                        <div class="icon_social">
                            <i class="fab fa-facebook-square icon icon_hover"></i>
                            <i class="fab fa-github-square icon icon_hover"></i>
                            <i class="fab fa-twitter-square icon icon_hover"></i>
                        </div>
                </div>
                <div style="animation: showru 0.4s;" id="signup" class="input_login">
                    <form onsubmit="return false" action="{{URL::to("admin/check-reg")}}" method="POST">
                        {{csrf_field()}}
                        <input id="reg_name" class="input_item" type="text" placeholder="Họ và Tên" name="displayname">
                        <br>
                        <input id="reg_user" class="input_item" type="text" placeholder="Tên đăng nhập" name="user">
                        <br>
                        <input id="reg_pass" class="input_item" type="text" placeholder="Mật khẩu" name="password">
                        <br>
                         <input id="reg_repass" class="input_item" type="text" placeholder="Nhập lại mật khẩu" name="email">
                        <br>
                        <div style="color: #E9E342" class="check_reg"></div>
                        <div class="agree_us">
                            <input type="checkbox" name=""> Đồng ý với <a href="#">điều khoản</a> của chúng tôi
                        </div>
                        <br>
                        <input id="btn_reg" class="input_item btn_reg" type="submit" value="Đăng Kí" name="">
                        <br>
                        <p style="text-align: center;">&copy; 2020 Codehero<p>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="landing-base">
        <nav class="header">
                <div id="progress_bar">
                </div>
                <div class="container-fluid site-header">
                    <div class="wrap-site-logo">
                        <a style="display: flex;align-items: center;" href="{{URL::to('#/')}}">
                            <img  src="{{asset('public/frontend/img/pic2.png')}}"/>
                            <span><img src="{{asset('public/frontend/img/Logo.png')}}"/></span>
                        </a>
                    </div>
                    <div class="wrap-header">
                        <ul class="header_list hide-on-table-and-moblie">
                            <li class="header_item"><a class="header_link" href="{{URL::to('#/course')}}">Chương trình đào tạo</a>
                                <ul class="course_cate" style="position: absolute;">
                                    @foreach($cate_course as $k =>$v)
                                    {{-- <li><a href="{{URL::to('course/category/'.$v->id_cate)}}">{{$v->name}}</a></li> --}}
                                    <li>
                                    <router-link tag="a" :to="{ path: '/course/category/{{$v->id_cate}}'}">{{$v->name}}</router-link>
                                    </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="header_item"><a class="header_link" href="{{URL::to('#/document')}}">Tài liệu</a>
                            </li>
                            <li class="header_item "><a class="header_link" href="{{URL::to('#/blog')}}">Chia sẻ</a>
                            </li>
                            <li class="header_item "><a class="header_link" href="{{URL::to('#/forum')}}">Thảo luận</a>
                            </li>
                        </ul>   
                    </div>
                    @if(!Session::get('id'))
                    <ul class="header_btn">
                        <li><button style="outline: none" class="btn btn-primary header_button btn_modal" >Đăng nhập</button></li>
                        <li><button style="outline: none" class="btn btn-danger header_button btn_modal hide-on-table-and-moblie">Đăng ký</button></li>
                    </ul>
                    @else
                    <div style="margin-right: 3em;display: flex;align-items: center;color: black">
                        <div status="0" class="notify">
                            <span style="position: relative;margin-right: 10px;"><i class="fas fa-bell btn btn-primary" style="font-size: 1.2rem"></i>
                            <span class="badge_notify"></span>
                            </span>
                            <div class="div_notify">
                                <div class="setting_notify">
                                    <span>Thông báo</span>
                                    <a href="#">Cài đặt</a>
                                </div>
                                <ul  class="list_notify">

                                </ul>

                            </div>
                        </div>
                        
                        <span style="margin-right: 16px">{{Session::get('coin')}} <i style="color: #ff8c00" class="fas fa-coins"></i></span>
                        
                        <div style="display: flex; align-items: center; height: 58px" class="dropdown">
                            <div style="width: 40px;height: 40px;border-radius: 50%;background: url('{{asset(Session::get('img'))}}');display: inline-flex;background-position: center;background-size: cover;"></div>
                            <span>{{Session::get('name')}}</span>
                            <div class="dropdown_user"><i style="padding-left: 4px" class="fas fa-caret-down"></i>                              
                            </div>
                            <div class="div_item">
                                    @if(Session::get('lv')==0)
                                    <li class="dropdown_item"><a href="{{URL::to("admin/dashboard")}}">Vào trang admin</a></li>
                                    @endif
                                    <li class="dropdown_item"><router-link tag="a" :to="{ path: '/me'}">Thông tin</router-link></li>
                                    <li class="dropdown_item"><router-link tag="a" :to="{ path: '/me/course'}">Khóa học của tôi</router-link></li>
                                    <li style="border-bottom: 1px solid #ccc" class="dropdown_item"><router-link tag="a" :to="{ path: '/me/blog'}">Bài viết của tôi</router-link></li>
                                    <li class="dropdown_item"><a href="{{URL::to("me/logout")}}">Đăng xuất</a></li>
                            </div>
                        </div>
                    </div>
                    @endif
                    <i style="color: black;font-size: 1.3rem;margin-left: 15px;" class="fas fa-bars hidden-on-pc btn_nav"></i>
                </div>
        </nav>
        {{-- @yield('content') --}}
            {{-- <router-view ></router-view> --}}
             <router-view></router-view>
            {{-- <HomeComponent></HomeComponent> --}}
        <footer>
            <div class="container mobile-container">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                        <ul class="adress">
                            <span>ĐỊA CHỈ</span>    
                                <li>
                                    <p>Hòa Quý, Ngũ Hành Sơn, Đà Nẵng</p>
                                </li>                               
                                <li>
                                    <p>+84 941 257 069</p>
                                </li>                               
                                <li>
                                    <p>pvtnguyet.19it1@sict.udn.vn</p>
                                </li>
                        </ul>
                    </div>               
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                        <ul class="contact">
                            <span>THÔNG TIN</span>    
                            <li>
                                <a href="#">Trang chủ</a>
                            </li>                              
                            <li>
                                <a href="#">Về chúng tôi</a>
                            </li>                             
                            <li>
                                <a href="#">Blog</a>
                            </li>                              
                            <li>
                                <a href="#">Thư viện</a>
                            </li>                               
                            <li>
                                <a href="#">Liên lạc</a>
                            </li>
                        </ul>
                    </div>                
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                        <div class="search-text"> 
                            <div class="container mobile-container">
                                <div class="row text-center">                             
                                    <div class="form">
                                        <span class="header-form">ĐĂNG KÍ NHẬN EMAIL</span>    
                                            <form id="search-form" class="form-search form-horizontal">
                                                <input type="text" class="input-search" placeholder="Email Address">
                                                <button type="submit" class="btn-search"><span style="font-size:15px;">SUBMIT</span></button>
                                            </form>
                                    </div>                          
                                </div>         
                            </div>     
                        </div>
                    </div>           
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                        <ul class="social">
                            <span>MẠNG XÃ HỘI</span>    
                               <li>
                                    <a href="#"><i class="fab fa-facebook fa-2x"></i></a>
                               </li>                             
                               <li>
                                    <a href="#"><i class="fab fa-github fa-2x"></i></a>
                               </li>                               
                               <li>
                                    <a href="#"><i class="fab fa-linkedin fa-2x"></i></a>
                               </li>                               
                               <li>
                                    <a href="#"><i class="fab fa-tumblr fa-2x"></i></a>
                               </li>                              
                               <li>
                                    <a href="#"><i class="fab fa-google-plus fa-2x"></i></a>
                              </li>                             
                        </ul>
                    </div>
                </div> 
            </div>
            <div class="container mobile-container">
              <hr>
              <div class="row">                 
                <div class="col-lg-4 copyright">
                  <span style="color: #ffffff; font-weight: normal">Copyright © 2020 CodeHeroes</span>
                </div>                  
              </div>
            </div>
        </footer>
    </div>
     </div>
</body>
<script src="{{asset('public/js/app.js')}}"></script>
<script src="{{asset('public/frontend/js/js.js')}}"></script>
<script type="text/javascript">
    function checkUser(txt) {
        var usernameRegex = /^[a-zA-Z0-9]+$/;
   if(txt.match(usernameRegex))
   {
    return false;
   }
   return true;
}
function CheckPassword(inputtxt) 
{ 
var passw=  /((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[\W]).{8,20})/;
if(inputtxt.match(passw)) 
{ 
return true;
}
else
{ 
return false;
}
}
    $('#btn_login').on('click', function(event) {
   $user = $('#input_user').val();
   $_token = $('input[name="_token"]').val();
   $pass = $('#input_pass').val();
   if ($user=='' || $pass==''){
       $('.check_login').html("Vui lòng điền đầy đủ thông tin")
   }else{
        $.ajax({
            url: '{{URL::to('check-login')}}',
            type: 'POST',
            data: {
                user:$user,
                pass:$pass,
                _token:$_token
            },success:function (data) {
                $('.check_login').html(data);
            },error:function (jqXHR, textStatus, errorThrown) {
                console.log(errorThrown);
            }
        })
    }
});
$('#btn_reg').on('click', function(event) {
   $reg_user = $('#reg_user').val();
   $_token = $('input[name="_token"]').val();
   $reg_pass = $('#reg_pass').val();
   $reg_name = $('#reg_name').val();
   $reg_repass = $('#reg_repass').val();
   if ($reg_user=='' || $reg_pass=='' || $reg_name==''|| $reg_repass==''){
       $('.check_reg').html("Vui lòng điền đầy đủ thông tin");
   }else if ($reg_pass.length<6) {
       $('.check_reg').html("Password không nhỏ hơn 6 kí tự");
   }else if(CheckPassword($reg_pass)){
        $('.check_reg').html("Không đúng định dạng password");
   }else if (!checkUser($reg_name)) {
    $('.check_reg').html("Tên đăng nhập không đúng định dạng");
   }
   else if ($reg_name.length>20) {
       $('.check_reg').html("Tên đăng nhập không quá 20 kí tự");
   }else if($reg_repass!=$reg_pass) {
        $('.check_reg').html("Password không khớp!");
    }
   else{
        $.ajax({
            url: '{{URL::to('check-reg')}}',
            type: 'POST',
            data: {
                reg_user:$reg_user,
                reg_pass:$reg_pass,
                reg_name:$reg_name,
                _token:$_token
            },success:function (data) {
                $('.check_reg').html(data);
            },error:function (jqXHR, textStatus, errorThrown) {
                console.log(errorThrown);
            }
        })
    }
});

$('#reg_pass').on('keyup', function(event) {
    if ($(this).val().length<6) {
        $('.check_reg').html("Password không nhỏ hơn 6 kí tự");
    }
    if (!CheckPassword($(this).val())) {
        $('.check_reg').html("Password không chứa kí tự đặc biệt");
    }
});
$('#reg_repass').on('keyup', function(event) {
    if ($('#reg_pass').val()!=$(this).val()) {
        $('.check_reg').html("Password không khớp!");
    }else{
        $('.check_reg').html("");
    }
});

function notification() {
    $link= "http://localhost/codehero/notify";
    $_token = $('input[name="_token"]').val();
    $.ajax({
        url: "{{URL::to('notify')}}",
        type: 'POST',
        data: {_token:$_token},
        success:function (data) {
            setTimeout(function (argument) {
            document.title=title;
            }, 1000);
            document.title='('+data+')'+title;
            $('.badge_notify').text(data);
        }
    })
}
// function unread() {
//     // setInterval(notification,4000);
//     setTimeout(notification,4000);
// }
// unread();
$('.notify').on('click',  function(event) {
    $stt =$(this).attr('status');
console.log($stt);
    $_token = $('input[name="_token"]').val();
    if (true) {
        $.ajax({
        url: "{{URL::to('list-notify')}}",
        type: 'POST',
        data: {_token:$_token},
        success:function (data) {
            $('.notify').attr('status', '1');
            $('.list_notify').html(data);
            $('.div_notify').show();
            // console.log("ok");
        }
    })
    }
});
$(".page").hide();
$('.page').click(function() {
    $('body,html').animate({
    scrollTop: 0
    })
    });
    $(window).scroll(function () {
    var e = $(window).scrollTop();
    if (e > 300) {
        $(".page").show();
    } else {
        $(".page").hide();
    }
});
$('.list_notify').on('click','.item_notify',function(event){
    $(this).css('background', 'white');
    $id_notify = $(this).attr('data-id');
    $stt_notify = $(this).attr('data-stt');
    if ($stt_notify==0) {
    $link= "http://localhost/codehero/set-notify";
    $.ajax({
        url: "{{URL::to('set-notify')}}",
        type: 'POST',
        data: {
            id_notify:$id_notify,
            _token:$_token},
        success:function (data) {
            console.log(data);
        }
    })
    }
});
</script>
<script type="text/javascript">
    
function move() {
    var i = 0;
  if (i == 0) {
    i = 1;
    var elem = document.getElementById("progress_bar");
    elem.style.display="block";
    var width = 1;
    var id = setInterval(frame, 10);
    function frame() {
      if (width >= 100) {
        clearInterval(id);
        elem.style.display="none";
        i = 0;
      } else {
        width++;
        elem.style.width = width + "%";
      }
    }
  }
}
$('a').on('click', function(event) {
    // move();
});
</script>
</html>