<template>
	<div class="mb-3">
		<div class="row">
			<div class="col-lg-2 col-md-12 col-sm-12 p-0">
				<div class="div_info_post info_post_mobile">
					<div class="forum_info_auth info_user_cmt" :style="{backgroundImage:'url(./'+cmt.avatar+')'}" style="background-position: center;background-size: cover;border-radius: 50%;border:1px solid #D9D7D7" ></div>
					<div class="div_level_user">
						<a class="link_user" style="font-weight: 500;margin-right: 4px" status="false" :username="cmt.id" href="">{{cmt.displayname}}
						<div class="user_name"></div>
						</a>
					</div>
				</div>
			</div>
			<div :id="'comment_' + cmt.id_cmt" style="border-radius: 4px;" class="col-lg-10 alert p-2 bg_cmt">
				<div style="display: flex;justify-content: flex-end;font-size: 0.8rem">
					#{{cmt.id_cmt}} | <span class="getTime">{{cmt.created_at}}</span>
				</div>
				<div v-html="cmt.content_cmt" :id="'cmt_forum_'+cmt.id_cmt" class="cmt_forum">
					
				</div>
				<div class="url">
					<link-prevue :url="getLink">
						<template slot-scope="props">
							<a v-bind:href="props.url">
					      <div class="card" style="width: 15rem;">
					        <img class="card-img-top" :src="props.img" :alt="props.title" />
					        <div class="card-block p-1">
					          <h4 class="card-title">{{props.title}}</h4>
					          <p >{{props.description}}</p>
					        </div>
					      </div>
					      </a>
					    </template>
					</link-prevue>
				</div>
				<div>
					<br>
					<template v-if="cmt.id_auth_cmt">
					<button v-on:click="onDelReactcmt"  style="line-height: 1;width: 80px" class="btn btn-info btn-sm"><i style="color: red" class="fas fa-heart"></i> {{cmt.num_cmt}} </button> 
					<v-btn @click='showReact'
				  elevation="2"
				  x-small
				  color="red lighten-2"
          dark
					>Xem</v-btn>
					</template>
					<template v-else>
					<button v-on:click="onReactcmt" style="line-height: 1;width: 80px" class="btn btn-info btn-sm">Like! {{cmt.num_cmt}}</button>
					<v-btn @click='showReact'
				  elevation="2"
				  x-small
				  color="red lighten-2"
          			dark
					>Xem</v-btn> 
					</template>
				</div>
				<div style="display: flex;justify-content: flex-end;">
					<i  title="Xóa" style="margin: 0 8px" :data-id="cmt.id_cmt" class="far fa-trash-alt del_cmt"></i>
					<i title="Sửa" style="margin: 0 8px" v-on:click="editCmt" class="fas fa-edit edit_cmt"></i>
					<i title="Xóa" style="margin: 0 8px" v-on:click="deleteCmt" class="far fa-trash-alt del_cmt"></i>
					<i v-on:click="isReply=!isReply" class="fas fa-reply btn_reply"></i>
				</div>
			</div>
		</div>
		<Reply
			v-for="(v,j) in reply"
			v-on:formReply="isReply=!isReply"
			v-bind:reply="v" :key="j">
		</Reply>
		<br>
		<div v-if="user"  style="padding-left: 100px">
			<form v-if="isReply" id="'form_reply_'+cmt.id_cmt" class="" onsubmit="return false">
				<div class="comment">
					<div class="info_cmt">
						<img class="img_cmt" :src="'./'+user.avatar" alt="">
						<h3 class="name_auth">{{user.displayname}}</h3>
					</div>
					<input class="input_cmt" :id="'reply_cmt_'+cmt.id_cmt" placeholder="Nhập để trả lời bình luận" name="cmt" v-model="rep.content" >
				</div>
				<div class="btn_cmt">
					<input class="btn btn-primary btn_reply_cmt " :data-cmt="cmt.id_cmt" :data-auth="user.id" :data-id="idPost" type="submit" link="comment_" v-on:click="replyCmt" value="Bình luận">
				</div>
			</form>
		</div>
	</div>

</template>

<script>
import LinkPrevue from 'link-prevue'
import Reply from './ReplyComponent';
export default {
  name: 'CommentComponent',
  data () {
    return {
    	rep:{},
    	isReply:false,
    	url:''
    }
  },
  components:{
  	Reply,
  	LinkPrevue
  },
  
  props:{
  	cmt: Object,
  	user: Object,
  	idPost:Number,
  	reply:Array
  },
  computed:{
  	getLink(){
  		let a='';
  		try {
  			a= this.cmt.content_cmt.match(/\bhttps?:\/\/\S+/gi)[0];
  			return a;
  		} catch(e) {
  			return a;
  		}
  	}
  },
  methods:{
  	deleteCmt(){
  		this.$emit('deleteCmt',{id:this.cmt.id_cmt,id_user:this.cmt.id});
  	},
  	editCmt(){
  		this.$emit('editCmt',{content:this.cmt.content_cmt,id:this.cmt.id_cmt});
  	},
  	replyCmt(){
  		this.$emit('replyCmt',{id_cmt:this.cmt.id_cmt,content:this.rep.content,id_user:this.cmt.id});
  	},
  	onDelReactcmt(){
  		this.$emit('onDelReactcmt',{id:this.cmt.id_cmt,id_r:this.cmt.id_r});
  		
  	},
  	onReactcmt(){
  		this.$emit('onReactcmt',{id:this.cmt.id_cmt,id_r:this.cmt.id_r});
  	},
  	showReact(){
  		this.$emit('showReact',{id:this.cmt.id_cmt});
  	}
  }
}
</script>

<style lang="css" scoped>
.bg_cmt{
	background: #D4D3D3;
}
.url p{
	line-height: unset; 
    letter-spacing: unset;
}
.url h4{
	margin-bottom:4px;
}
.url{
	color:black;
}
</style>