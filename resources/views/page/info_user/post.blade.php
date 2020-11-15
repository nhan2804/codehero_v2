@extends('welcome')
@section('title',"Bài viết của tôi")
@section('content')
<br>
<br>
<br>
<div class="container">
<div class="row">
<div class="col-lg-12">
	<h3>Danh sách bài viết</h3>  
	<div class="table-responsive">
	<a class="btn btn-success option" href="#add_blog"><i class="fas fa-plus"></i> Thêm bài viết</a> 
	<button class="btn btn-danger option" id="del_blog"><i class="fas fa-ban"></i> Xóa</button>
	<br>
	<input type="text" placeholder="Tìm kiếm..." class="form-control option" name="">
	</div>
	<br>
	<br>       
		  <table class="table list">
		    <thead>
		      <tr>
		        <th><input class="check-all" type="checkbox" name="">@csrf</th>
		        <th>Tiêu đề bài viết</th>
		        <th>Tình trạng</th>
		        <th>Lượt xem</th>
		        <th>Chức Năng</th>
		      </tr>
		    </thead>
		    <tbody>
			   @foreach($data as $key=>$value)
			   <tr>
			   <td><input type="checkbox" value="{{$value['id_blog']}}" name=""></td>
			   <td>{{$value['title_blog']}}</td>
			   @if($value['stt_blog']==0)
			   <td class="text-success">Đã duyệt</td>
			   @else
			   <td class="text-danger">Chưa duyệt</td>
			   @endif
			   <td>{{number_format($value->view_blog)}}</td>
		        <td><a class="" href="{{URL::to('/edit-blog/'.$value['id_blog'])}}"><i class="far fa-edit"></i> Sửa</a>
		        <a onclick="return confirm('Bạn có chắc muốn xóa danh mục này không?');" class="" href="{{URL::to('/del-blog/'.$value['id_blog'])}}"><i class="far fa-trash-alt"></i>Xóa</a>
		        </td>
		        </tr>
			   @endforeach
		    </tbody>
		  </table>
		  {{ $data->links() }}
		</div>
	<div id="add_blog" class="col-lg-12">
		<form action="{{URL::to('admin/blog/insert-blog')}}" method="post" enctype="multipart/form-data">
	{{csrf_field()}}
			<?php
		if (Session::get('success')) {
			echo Session::get('success');
		}
		?>
	<div class="form-group">
		<label>Tiêu đề bài viết</label>
		<input class="form-control" type="text" name="title_blog">
		<label>Ảnh bài viết</label>
		<input type="file" name="img_upload" id="img_upload" accept="image/*">
		<br>
		<label>Nội dung bài viết</label>
		<textarea id="edit_post" class="form-control" name="content_blog" cols="80" rows="10"></textarea>
		<label>Chủ đề bài viết</label>
		<select name="cate_parent" class="form-control">
			@foreach($data as $key=>$value)
			<option value="{{$value['id']}}">{{$value['name']}}</option>
			@endforeach
		</select>
		<input type="submit" name="" class="btn btn-primary" value="Đăng bài">
	</div>
	</form>
	</div>
@if (count($errors) > 0)
     <div class = "alert alert-danger">
        <ul>
           @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
           @endforeach
        </ul>
     </div>
 @endif

</div>
</div>
<script>
    config = {};
    config.entities_latin = false;
    config.language = "vi";
    CKEDITOR.replace("edit_post", config);
</script>