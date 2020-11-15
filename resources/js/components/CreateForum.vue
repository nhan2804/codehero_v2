<template>
	<div class="container">
		<br>
		<br>
		<br>
<form method="post" action="blog/insert-forum">
	<input type="hidden" name="_token" :value="csrf">
  <div class="form-group">
    <label for="">Tiêu đề</label>
    <input v-model="item.title" type="text" class="form-control" name="title_forum" id="title_forum">
  </div>
  <div class="form-group">
    <label for="">Slug bài viết</label>
    <input v-model="item.slug" type="text" class="form-control" name="slug_forum" id="slug_forum">
  </div>
  <input id="bgcolor" type="hidden" name="bgcolor" value="">
  <div class="form-group">
    <label >Nội dung </label>
    <textarea v-model="item.body" id="edit_post" name="content_forum"></textarea>
  </div>
  <div class="form-group">
    <label>Chủ Đề</label>
    <select name="cate_forum">
    	<option :value="e.id_cate" v-for="e of cate">{{e.name_cate}}</option>
    </select>
  </div>
  <button type="submit" class="btn btn-info">Đăng</button>
</form>
</div>
</template>

<script>
export default {

  name: 'CreateForum',
  mounted(){
   CKEDITOR.replace('edit_post');

  },
  created(){
	this.loadCate();
  },
  updated(){
  },

  data () {
    return {
    	item:{},
    	user:{},
    	cate:{},
    	csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    }
  },
  methods:{
  	loadCate:function() {
		axios.get('api/forum/category')
		.then((resp)=>{
			this.cate=resp.data.cate_forum;
			this.user=resp.data.user;
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