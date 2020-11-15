@extends('welcome')
@section('title',"Blog")
@section('content')
<br>
<br>
<div class="container">
	<div style="display: flex;justify-content:space-between;margin: 24px -10px 10px -10px">
	<span></span>
	<form style="width: 300px;display: block;position: relative;">
		{{ csrf_field()}}
		<div class="form_search">
			<input type="text" id="input_search" placeholder="Nhập để tìm kiếm" name="">
			<i class="fas fa-search icon_search"></i>
		</div>
		<ul id="rs_search" class="list_popular hidden" style="position: absolute;z-index: 9;padding: 0 4px;background: #F6ED60;width: 100%;box-sizing: border-box;margin-bottom: 0">
			<div class="effect hidden">
		 	<div class="loading"></div>
		 	<div class="loading"></div>
		 	<div class="loading"></div>
		 	<div class="loading"></div>
		</div>
		</ul>
	</form>
	</div>
	<div style="margin: 0 -10px" class="img_head hide-on-table-and-moblie">
	 <img src="{{asset('public/images/ShareWall.png')}}"/>
	</div>
	<br class="hide-on-table-and-moblie">
	
	<br>	
		<div class="row">
			<div class="col-5 col-lg-3 col-sm-5 gutter-6">
				<?php $i=1;?>
				@foreach($data->skip(0)->take(5) as $key=>$value)
				<div style="margin-bottom: 12px;" class="div__blog--hover" class="item_small_blog">
					<div style="background:url({{asset('public'.$value->img_blog)}});background-position: center;background-size: cover; height: 120px;border: 1px solid #ccc"></div>
					<div class="info_blog">
						<div class="blog_rank">
							{{$i}}
						</div>
						<div class="blog_name" style="flex: 1">
							<span style="background: {{$value->color_cate}}" class="blog_cate">{{$value->name}}</span>
							<a class="title__blog--link" href="{{URL::to('forum/post/'.$value->id_blog)}}">{{$value->title_blog}}</a>
						</div>
					</div>
				</div>
				<?php $i++;?>
				@endforeach
			</div>
			<div class="col-7 col-lg-5 col-sm-7 gutter-6">
				<div class="item_big_blog">
					@foreach($data->skip(5)->take(4) as $key=>$value)
					<div  class="div__blog--hover" style="background:url({{asset('public'.$value->img_blog)}});background-position: center;background-size: cover; height: 230px;margin-bottom: 12px;position: relative;">
						<div class="item_meta">
							<span class="item_cate" style="color:{{$value->color_cate}}">{{$value->name}}</span>
							<span class="item_date">/ {{$value->created_at}}</span>
							<a class="item_link" href="{{URL::to('forum/post/'.$value->id_blog)}}">
								<h3>{{$value->title_blog}}</h3>
							</a>
						</div>	
					</div>
					@endforeach
				</div>
			</div>
			<div class="col-12 col-lg-4 col-sm-12 gutter-6 ">
				<div class="item_big_blog horizontal">
					@foreach($data->skip(9)->take(4) as $key=>$value)
					<div class="div__blog--hover div_blog_medium" style="background:url({{asset('public'.$value->img_blog)}});background-position: center;background-size: cover; ">
						<div class="item_meta">
							<span class="item_cate" style="color:{{$value->color_cate}}">{{$value->name}}</span>
							<span class="item_date">/ {{$value->created_at}}</span>
							<a class="item_link item_link_cus" href="{{URL::to('forum/post/'.$value->id_blog)}}">
								<h3>{{$value->title_blog}}</h3>
							</a>
						</div>	
					</div>
					@endforeach
				</div>
			</div>
		</div>
		<br>
		<div class="under_line">
			<div style="border-radius: unset;outline: none;background: #F24F1D" class="heading-new btn btn-primary">Mới nhất</div>
		</div>
		<br>
		<div class="row">
			<div class="col-lg-8 col-md-12 col-sm-12 col-12">
				<div class="list_blog">
					@foreach($blog_new as $key=>$value)
					<div class="row mb-3">
						<div class="col-lg-5 col-md-5 col-sm-12 col-12">
							<div style="background:url({{asset('public'.$value->img_blog)}});background-position: center;background-size: cover; height: 180px;padding: 4px 0;"></div>
						</div>
						<div class="col-lg-7 col-md-7 col-sm-12 col-12">
							<div>
								<span style="background: {{$value->color_cate}}" class="blog_cate">{{$value->name}}</span>
								<a class="item_link " href="{{URL::to('forum/post/'.$value->id_blog)}}">
								<h3 style="color: #333;font-weight: 490;margin: 6px 0">{{$value->title_blog}}</h3>
								</a>
								<span style="color: #333;" class="item_date">{{ \Carbon\Carbon::parse($value->created_at)->diffForHumans() }}  - {{number_format($value->view_blog)}} lượt xem</span>
								<div class="div_conten-blog">
									{!!$value->content_blog!!}
								</div>
							</div>
						</div>
					</div>
					@endforeach
				</div>
				<input type="hidden" id="row_curr" value="5" name="">
					<div style="display: flex;justify-content: center;">
						<button id="see_more" style="border-radius: unset;outline: none;" class="btn btn-primary ">Xem thêm</button>
					</div>
			</div>
			<div class="col-md-4 col">
				<div class="hide-on-table-and-moblie">
					<img src="{{asset('public/images/Banner-7.png')}}" style="width: 16em; margin-left: 7em" class="banner_shadow"/>
				</div>
			</div>
	</div>
</div>
@endsection
