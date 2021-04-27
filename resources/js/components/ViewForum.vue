 <template>
	<div>
		
    <br>
    <br>
    <br>
	<div class="container p-0">
		<input type="hidden" id="title_web" :value="datas.title_post" name="">
		<div class="row">
			<div class="col-12">
				<div :style="{backgroundImage:'url(./'+datas.img_cate+')'}" style="background:;background-position: center;background-size: cover;height: 200px;position: relative;">
					<div style="position: absolute;background: rgba(255,255,255,.4);width: 100%;padding: 2px 8px;"><b><a href="#">{{datas.name_cate}}</a></b> | <a href="#">Hoạt động</a></div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
					<ul class="list_redicrect" style="display: flex;flex-wrap: wrap;">
						<li><a href="">Forum</a></li>
						<li><i class="fas fa-angle-right"></i><a href=""> {{datas.name_cate}}</a> <i class="fas fa-angle-right"></i></li>
						<li><a style="color: #333" href="#"> {{datas.title_post}}</a></li>
					</ul>
					<br>
	    	</div>
			<div class="col-lg-3 col-md-12 col-sm-12 info_post_mobile p-0">
				<div class="forum_info_auth info_user_post" :style="{backgroundImage:'url(./'+datas.avatar+')'}"  style=";background-position: center;background-size: cover;border-radius: 50%;" ></div>
				<div class="div_level_user">
					<form method="POST" class="form_user">
					<a class="link_user" style="font-weight: 500" status="false" :username="datas.id" href="">{{datas.displayname}}
					<div class="user_name"></div>
					</a>
					</form>
					<span class="getTime hide-on-table hidden-on-pc "><i class="far fa-clock"></i> {{datas.created_at}}</span>
				</div>
			</div>
			<div class="col-lg-9 p-0">
				<div style="background: #e2ecf0;border: 5px solid #fff;box-shadow: 1px 2px 3px gray;border-radius: 16px;padding: 4px 8px">
					<div style="display: flex;justify-content: flex-end;font-size: 0.8rem">
						<span class="getTime">{{datas.created_at}}</span>
						<span class="getTime hide-on-mobile">{{datas.created_at}}</span>
					</div>
					<div class="cmt_forum">
						<h3 style="text-transform: uppercase;">{{datas.title_post}}</h3>
						<hr>
						<div v-html="datas.content_post" class="content_post">
						</div>
					</div>
					<div>
						<br>
						<form onsubmit="return false" action="post">
							<button v-if="user_react" :data-id="datas.id_post" style="line-height: 1;width: 100px" class="btn btn-primary btn-sm btn_react"><i style="color: red" class="fas fa-heart"></i> Đã thích</button>
							<button v-else :data-id="datas.id_post" style="line-height: 1;width: 100px" class="btn btn-info btn-sm btn_react">Thích</button>
						<span v-html="allreact"></span>
						</form>
					</div>
					<div class="socials-share" style="display: flex;justify-content: flex-end;margin: 0">
			    	<a class="bg-facebook" href="https://www.facebook.com/sharer/sharer.php?u=" target="_blank"><i class="fab fa-facebook-f"></i> Share</a>
					</div>
				</div>
			</div>
		</div>
		<br>
		<div class="d-flex justify-content-end">
			<pagination v-bind:pagination="pagination" :offset="4"></pagination>
		</div>
		<br>
		<div style="display:flex;justify-content:flex-end">
			<button class="btn btn-light mr-2" v-on:click="asc">Mới nhất</button>
			<button class="btn btn-dark" v-on:click="desc">Cũ nhất</button>
		</div>
		
		<br>
		<Comment v-viewer="{movable: false}" v-for="(value,i) in reply"
				v-bind:cmt="value" :key="i"
				v-bind:reply="value.reply"
				v-on:deleteCmt="deleteCmt"
				v-on:editCmt="editCmt"
				v-bind:user="user"
				v-bind:idPost="datas.id_post"
				v-on:replyCmt="replyCmt"
				v-on:onReactcmt="onReactcmt"
				v-on:onDelReactcmt="onDelReactcmt"
				v-on:showReact="showReact"
				>	
		</Comment>
		<br>
		<pagination v-bind:pagination="pagination" :offset="4"></pagination>
		<br>
		<div class="d-flex justify-content-end mb-2 wrap-preview">
			<div v-if="url" id="preview">
			    <img  :src="url" />
			</div>
			<i v-on:click="hiddenPreview" class="fas fa-times btn_close"></i>
		</div>
		<form v-if="user" onsubmit="return false" enctype="multipart/form-data">
			<div class="comment">
				<div class="info_cmt">
					<img class="img_cmt" style="width:70px;height:70px" :src="'./'+user.avatar" alt="">
					<h3 class="name_auth">{{user.displayname}}</h3>
				</div>
				<input @paste="onPaste" v-model="cmt.content" class="input_cmt" placeholder="Nhập để bình luận,dán ảnh vào đây" name="cmt" id="cmt_input"/>
			</div>

			<div class="btn_cmt">
				<i @click="$refs.file.click()" style="font-size:1.8rem" class="mr-2 fas fa-paperclip">
					
				</i>
				<input v-on:click="addCmt"  class="btn btn-primary" type="submit"  value="Bình luận">
				<input @change="onFileChange" type="file" id="file" style="display: none" ref="file" name="file">
				
			</div>

		</form>
		<h3 v-else class="left_cmt">Đăng nhập để bình luận</h3>
	</div>
	<template>
  <div class="text-center">
    <v-dialog
      v-model="dialog"
      width="500"
    >
      <v-card>
        <v-card-title class="headline grey lighten-2">
          Xem tất cả lượt thích
        </v-card-title>
    	<v-card-text>
        <div class="img-avt d-flex mb-2 align-items-center" v-for="v in react_cmt" :key="v.id_cmt">
        	<img :src="'./'+v.avatar" alt="">
        	<h3>{{v.displayname}}</h3>
        	
        </div>
        <div v-if="load_react_cmt">
        <div class="d-flex mb-2 align-items-center">
        	<div class="ske-img"></div>
        	<h3 class="ske-title"></h3>
        </div>
        <div class="d-flex mb-2 align-items-center">
        	<div class="ske-img"></div>
        	<h3 class="ske-title"></h3>
        </div>
        <div class="d-flex mb-2 align-items-center">
        	<div class="ske-img"></div>
        	<h3 class="ske-title"></h3>
        </div>
        </div>
        </v-card-text>

        <v-divider></v-divider>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="primary"
            text
            @click="dialog = false"
          >
            Đóng
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>
</div>
</template>
<script>
import Comment from './CommentComponent';
import Pagination from './Pagination';
import 'viewerjs/dist/viewer.css'
  import Viewer from 'v-viewer'
  import Vue from 'vue'
  Vue.use(Viewer)
export default {

  name: 'ViewForum',
  components:{
  	Comment,
  	Pagination
  },
  data () {
    return {
    	load_react_cmt:true,
    	react_cmt:[],
    	dialog: false,
    	elem:8,
    	turn:4,
    	width:1,
    	load:true,
    	cmt:{},
    	user:{},
    	id:this.$route.params.id,
    	user_react:false,
    	datas:{},
    	cmt_parent:[],
    	cmt_child:[],
    	allreact:0,
    	allcmt:[],
    	url:null,
		file:'',
		pre_url:null,
    	pagination: {
            total: 0,
            per_page: 2,
            from: 1,
            to: 0,
            current_page: 1
        },
        offset: 4,
        query:this.$route.query.page || 1
    }
  },
  computed:{
  	reply(){
  		return this.cmt_parent.map((v,i)=>{
  			v.reply=[];
  			this.cmt_child.map((v1,i1)=> {
  				if(v.id_cmt==v1.id_parent){
  					v.reply.push(v1);
  				}
  			})
  			return v;
  		})
  	}
  },
  mounted(){
  	
  	
  },
  created(){
	   this.loadViewForum();
  	this.process();
    this.startLiveCmt();
  	
  },
  updated(){
  	document.title = this.datas.title_post;
	  this.cmt.id_post=this.datas.id_post;

  },
  methods:{
    startLiveCmt(){ 
      setInterval(()=>{
      axios.get('api/forum/live-cmt/'+this.id)
    .then((rep)=> {
      this.cmt_parent= rep.data.allcmt.data;
      
      this.cmt_child= rep.data.cmt_child; 
    })
    .catch((e)=>{
      console.log(e);
    })
      },5000);
    },
    liveCmt(){
      axios.get('api/forum/live-cmt/'+this.id)
    .then((rep)=> {
      this.cmt_parent= rep.data.allcmt.data;
      
      this.cmt_child= rep.data.cmt_child; 
    })
    .catch((e)=>{
      console.log(e);
    })
    },
  	loadViewForum() {
		axios.get('api/forum/'+this.id+'/slug/?page='+this.query)
		.then((rep)=> {
			this.datas= rep.data.datas;
			this.cmt_parent= rep.data.allcmt.data;
			this.pagination =rep.data.allcmt;
			this.cmt_child= rep.data.cmt_child;
			this.user_react= rep.data.user_react;
			this.allreact = rep.data.allreact;
			this.user = rep.data.user;
			
		})
		.catch((e)=>{
			console.log(e);
		})
    },
    hiddenPreview(){
    	this.url=null;
    },
    onPaste(e){
    	const file = e.clipboardData.files[0];
    	console.log('test');
  		console.log(file);
		  this.url = URL.createObjectURL(file);
		  this.pre_url= this.url;
      	let fr = new FileReader();
      	fr.readAsDataURL(file);
      	fr.onload=(e)=>{
      		this.file=e.target.result;
      	}
    },
    onFileChange(e){
    	const file = e.target.files[0];
		  this.url = URL.createObjectURL(file);
		  this.pre_url= this.url;
      	let fr = new FileReader();
      	fr.readAsDataURL(file);
      	fr.onload=(e)=>{
      		this.file=e.target.result;
      	}
      	
     
    },
    onReactcmt(id){
    	axios.post('api/forum/react-cmt',{
    		id:id.id,
    		id_r:id.id_r
    	})
		.then((rep)=>{
		  // alert(rep.data);
		 this.cmt_parent.forEach((el,i)=>{
    		if(el.id_cmt==id.id){
    			el.num_cmt+=1;
    			el.id_auth_cmt=1;
    		}
    	});
		})
		.catch((e)=> {
		  console.log(e);
		});
    },
    showReact(id){
    	this.load_react_cmt=true;
    	this.react_cmt=[];
    	this.dialog=!this.dialog;
    	this.loadShowReactCmt(id);
    },
    onDelReactcmt(id){
    	axios.post('api/forum/del-react-cmt',{
    		id:id.id,
    		id_r:id.id_r
    	})
		.then((rep)=>{
		 this.cmt_parent.forEach((el,i)=>{
    		if(el.id_cmt==id.id){
    			el.num_cmt-=1;
    			el.id_auth_cmt=null;
    		}
    	});
		})
		.catch((e)=> {
		  console.log(e);
		});
    }
    ,
    deleteCmt(id){
    	if (confirm("Bạn có chắc muốn xóa bình luận này không?")) {
    	axios.post('api/forum/del-cmt',{
    		id:id.id
    	})
		.then((rep)=>{
		  this.getIndex(id.id);
		})
		.catch((e)=> {
		  console.log(e);
		});
		}
    },
    loadShowReactCmt(id){
    	axios.get('api/forum/show-react/'+id.id)
		.then((res)=>{
		  // console.log(res.data);
		  this.react_cmt=res.data;
		  this.load_react_cmt=false;
		})
		.catch((e)=> {
		  console.log(e);
		});
		
    },
    editCmt(id){
    	this.cmt.content= id.content;
    	var index=getIndex(id.id);
    	this.cmt_parent[index].content=cmt.content;
    },
    getIndex(id){
    	this.cmt_parent.forEach((el,i)=>{
    		if(el.id_cmt==id){
    			this.cmt_parent.splice(i, 1);
    		}
    	});
    },
    addCmt(){
		// if(this.file){

		// }
        this.addImg();
    	
    },
    async addImg(){
    	let res ='';
    	if (this.file.length>6) {
    	
        let data = new FormData();
		data.append("image", this.file.split(",")[1]);
		this.url=null;
		this.cmt_parent.push({
			...this.user,
			content_cmt:this.cmt.content+'<div class="wrap_pre_img"><i  class="fas fa-snowflake pre_load_img"></i><img style="opacity:0.4;width:100%;" class="d-block" src="'+this.pre_url+'" /></div>'
		});
    	res =await axios.post('https://api.imgbb.com/1/upload?key=e715699b8e273a068bfaf6685f07e0c4',data);
		if(res.status==200){
			console.log("error");
		}
		}
			let save =await axios.post('api/forum/add-api', {
			file_img:res?res.data.data.display_url:'',
			content: this.cmt.content,
			id_post: this.cmt.id_post,
			id_user: this.datas.id,
			link:window.location.href,})
			this.url=null;
			this.file='';
			this.cmt.content='';
			this.cmt_parent.splice(-1,1);
			this.cmt_parent.push(save.data);
    },
    replyCmt(data){
    	axios.post('api/forum/reply', {
		  content:data.content,
		  id_post: this.datas.id_post,
		  id_cmt: data.id_cmt,
		  title:data.title_post,
		  id_user:data.id_user,
		  link:window.location.href,
            headers: {
               'Content-Type': 'multipart/form-data'
            }
		})
		.then((rep)=>{
		  this.cmt_child.push(rep.data);
		})
		.catch((e)=> {
		  console.log(e);
		});
    },

    asc(){
    	this.cmt_parent.reverse();
    },
    desc(){
    	this.cmt_parent.reverse();
    },
	process:function() {
	    this.elem = document.getElementById("progress_bar");
	    this.turn = setInterval(this.frame, 10);
	  },
	frame:function(){
    	if(this.width>= 100) {
        clearInterval(this.turn);
        this.elem.style.width = 0 + "%";
      	}else {
	      	if(this.width>=60 && this.load){
	      		this.width+=1;
	      	}else if(!this.load){
	      		this.width+=10;
	      	}else{
	      		this.width+=3;
	      	}
        this.elem.style.width = this.width + "%"; 
      }
	}
  },
  watch: {
    $route() {
        this.query=this.$route.query.page;
        this.loadViewForum();
    }
}
}
</script>

<style lang="css" scoped>
.img-avt img{
	width:40px;
	height:40px;
	border-radius:50%;
}
.ske-img{
	width:40px;
	height:40px;
	border-radius:50%;
	background: gray;
}
.ske-title{
	background: gray;
	height:16px;
	width:80px;
}
</style>