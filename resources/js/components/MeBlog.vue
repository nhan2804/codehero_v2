<template>
	<div>
	<br>
	<br>
	<br>
	<div class="container">
<div class="row">
<div class="col-lg-12">
	<h3>Danh sách bài viết</h3>  
	<div class="table-responsive">
	<a class="btn btn-success option" href="#add_blog"><i class="fas fa-plus"></i> Thêm bài viết</a> 
	<button class="btn btn-danger option" id="del_blog"><i class="fas fa-ban"></i> Xóa bài viết</button>
	<br><br>
	<input type="text" placeholder="Tìm kiếm..." class="form-control option" name="">
	</div>
	<br>
	<br>       
		  <table class="table list">
		    <thead>
		      <tr>
		        <th><input class="check-all" type="checkbox" name=""></th>
		        <th>Tiêu đề bài viết</th>
		        <th>Tình trạng</th>
		        <th>Lượt xem</th>
		        <th>Chức Năng</th>
		      </tr>
		    </thead>
		    <tbody>
			   <tr v-for="value in datas">
				   <td><input type="checkbox" name=""></td>
				   <td>{{value.title_blog}}</td>
				   <td class="text-success">Đã duyệt</td>
				   <td>{{value.view_blog}}</td>
			        <td><a class="" href="#"><i class="far fa-edit"></i> Sửa</a>
			        <a onclick="return confirm('Bạn có chắc muốn xóa danh mục này không?');" class="" href="#"><i class="far fa-trash-alt"></i>Xóa</a>
			        </td>
		        </tr>
		    </tbody>
		  </table>
		</div>
	<div id="add_blog" class="col-lg-12">
		<form action="" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Tiêu đề bài viết</label>
		<input class="form-control" type="text" name="title_blog"><br>
		<label>Ảnh bài viết</label>
		<input type="file" name="img_upload" id="img_upload" accept="image/*">
		<br>
		<label>Nội dung bài viết</label>
		<textarea id="edit_post" class="form-control" name="content_blog" cols="80" rows="10"></textarea><br>
		<label>Chủ đề bài viết</label>
		<select name="cate_parent" class="form-control">
			<option value="">Vui thôi</option>
		</select><br>
		<input type="submit" name="" class="btn btn-primary" value="Đăng bài">
	</div>
	</form>
	</div>
</div>
</div>
</div>
</template>

<script>
export default {

  name: 'MeBlog',

  data () {
    return {
    	datas:[]
    }
  },
  mounted(){
  	CKEDITOR.replace('edit_post');
  },
  created(){
    
    this.loadBlog();
  },
  methods:{
  	loadBlog:function() {
		axios.get('api/me/blog')
		.then((resp)=>{
			this.datas= resp.data;
		})
		.catch((e)=>{
			console.log(e);
		})
	}
  }
}
</script>

<style lang="css" scoped>
</style>