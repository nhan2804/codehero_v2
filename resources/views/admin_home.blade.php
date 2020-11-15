<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Tổng quan</title>
<link href="{{asset('public/backend/css/bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('public/backend/css/styles.css')}}" rel="stylesheet">
<script src="{{asset('public/backend/js/jquery-1.11.1.min.js')}}"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.1/dropzone-amd-module.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.1/basic.min.css">
{{-- <link href="{{asset('public/backend/css/all.min.css')}}" rel="stylesheet">
<link href="{{asset('public/backend/css/solid.min.css')}}" rel="stylesheet"> --}}
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
<script src="{{asset('public/backend/ckeditor/ckeditor.js')}}"></script>	
</head>
<body>
	<nav class="navbar navbar-inverse" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="#">Admin</a>
				<ul class="user-menu">
					<li class="dropdown pull-right">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg>
							<?php
							if (Session::get('name')) {
							   echo Session::get('name');
							}
							 ?>
							<span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="{{URL::to('/')}}"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg>Quay lại trang chủ</a></li>
							<li><a href="{{URL::to('me/logout')}}"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg>Logout</a></li>
						</ul>
					</li>
				</ul>
			</div>
							
		</div>
	</nav>
		
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<ul class="nav menu">
			<li class="active"><a href="{{URL::to('/admin/dashboard')}}"><i class="fas fa-tachometer-alt"></i> Trang chủ</a></li>
			<li><a href="{{URL::to('/admin/blog')}}"><i class="fas fa-folder-plus"></i> Blog</a>
			</li>
			<li><a href="{{URL::to('/admin/forum')}}"><i class="fas fa-book"></i> Forum</a>
			</li>
			<li><a href="{{URL::to('/admin/course')}}"><i class="fas fa-th"></i> Khóa học</a></li>
			<li><a href="{{URL::to('/admin/document')}}"><i class="fas fa-th"></i> Tài Liệu</a></li>
			<li><a href="{{URL::to('/admin/account')}}"><i class="far fa-address-card"></i> Tài khoản</a></li>
			<li><a href="{{URL::to('/admin/account')}}"><i class="fas fa-info"></i> Chi tiết</a></li>
		</ul>
	</div>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">		
		<div class="row">
			<div class="col-lg-12">
				<div style="padding: 8px;border-left: 5px solid #58d0da;background: #c0edf1;display: flex;align-items: center;">
					<p style="margin: 8px">Hi, chào mừng bạn đến với trang quản trị của Cohero, nếu có gì thắc mắc vui lòng liên hệ<a href="#"> tại đây</a></p>
				</div>
				@yield('admin_content')
			</div>
		</div>
	</div>
	
	<script src="{{asset('public/backend/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('public/backend/js/js.js')}}"></script>
</body>

</html>
