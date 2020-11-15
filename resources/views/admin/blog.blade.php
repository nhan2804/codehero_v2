@extends('admin_home')
@section('admin_content')
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
		<br><br>
			<label>Danh sách bài viết</label>  
			
			<div class="table-responsive">
				<div style="display: flex;">
			<a class="btn btn-success option" href="{{URL::to("/admin/blog/add-blog")}}"><i class="fas fa-plus"></i> Thêm bài viết</a> 
			<a href="{{URL::to("/admin/blog")}}" class="btn btn-default option"><i class="fas fa-sync-alt"></i> Reload</a> 
			<button class="btn btn-danger option" id="del_blog"><i class="fas fa-ban"></i> Xóa</button>
			<button class="btn btn-primary option" id="access_blog"><i class="fas fa-check"></i> Duyệt</button>
			<button class="btn btn-warning option" id="deny_blog"><i class="fas fa-minus-circle"></i> Hủy duyệt</button>
			<select option>
				<option>Tất cả</option>
				<option>Đã duyệt</option>
				<option>Chưa duyệt</option>
			</select>
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
					   @foreach($blog as $key=>$value)
					   <tr>
					   <td><input type="checkbox" value="{{$value['id_blog']}}" name=""></td>
					   <td>{{$value['title_blog']}}</td>
					   @if($value['stt_blog']==0)
					   <td><a class="text-success" href="{{URL::to('admin/blog/deny/'.$value['id_blog'])}}">Đã duyệt</a></td>
					   @else
					   <td><a class="text-danger" href="{{URL::to('admin/blog/accept/'.$value['id_blog'])}}">Chưa duyệt</a></td>
					   @endif
					   <td>{{number_format($value->view_blog)}}</td>
				        <td><a class="" href="{{URL::to('/edit-blog/'.$value['id_blog'])}}"><i class="far fa-edit"></i> Sửa</a>
				        <a onclick="return confirm('Bạn có chắc muốn xóa danh mục này không?');" class="" href="{{URL::to('/del-blog/'.$value['id_blog'])}}"><i class="far fa-trash-alt"></i>Xóa</a>
				        <a href="#"><i class="far fa-eye"></i> Xem trước</a>
				        </td>
				        </tr>
					   @endforeach
				    </tbody>
				  </table>
				  {{ $blog->links() }}
  			</div>
		</div>
		<div class="col-lg-12">
			<form method="POST" action="{{URL::to("/admin/blog/add-cate-blog")}}">
				{{csrf_field()}}
				<div class="form-group">
					<label>Tên Danh Mục</label>
					<input class="form-control" type="text" name="name_cate">
					<br>
					<button class="btn btn-success" type="submit" name=""><i class="fas fa-plus"></i> Thêm</button>
				</div>
			</form>
			<div class="table-responsive">       
				  <table class="table table-striped">
				    <thead>
				      <tr>
				      	<th><input type="checkbox" name=""></th>
				        <th>Tên Danh Mục</th>
				        <th>Chức Năng</th>
				      </tr>
				    </thead>
				    <tbody>
				    @foreach($data as $key=>$value)
				      <tr>
				        <td><input type="checkbox" value="{{$value['id']}}" name=""></td>
				        <td>{{$value['name']}}</td>
				        <td><a class="" href="{{URL::to('/edit-cate-blog/'.$value['id'])}}"><i class="far fa-edit"></i> Sửa</a>
				        <a onclick="return confirm('Bạn có chắc muốn xóa danh mục này không?');" class="" href="{{URL::to('/del-cate-blog/'.$value['id'])}}"><i class="far fa-trash-alt"></i> Xóa</a>
				        </td>
				      </tr>
				    @endforeach
				    </tbody>
				  </table>
  			</div>
		</div>
		
	</div>
</div>
@endsection