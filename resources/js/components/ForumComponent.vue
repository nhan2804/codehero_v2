<template>
<div class="container p-0">
	<br>
	<br>
	<br>
	<div v-if="user!=null" style="display: flex;justify-content: center;">
		<a href="blog/create-forum"  class="btn "></a>
		<router-link tag="a" class="btn" style="border: 2px solid #007bff" :to="{ path: '/forum/create/'}"><i class="fas fa-plus"></i> Thảo luận</router-link>
	</div>
	<br>
	<br>
	<div class="row">
		<div class="col-lg-8">
			<div class="row">
				<div class="col-lg-12">
					<div style="border-radius: unset;outline: none;width: 200px" class=" btn btn-primary"><i class="far fa-newspaper"></i> Mới nhất</div>
				</div>
				<template v-if="load">
				<div class="col-lg-12"><div class="forum_load"></div></div>
				<div class="col-lg-12"><div class="forum_load"></div></div>
				<div class="col-lg-12"><div class="forum_load"></div></div>
				<div class="col-lg-12"><div class="forum_load"></div></div>
				<div class="col-lg-12"><div class="forum_load"></div></div>
				<div class="col-lg-12"><div class="forum_load"></div></div>
				</template>
				<ItemForum
				v-for="(v,i) in datas.data"
				:key="i"
				:value="v">
				</ItemForum>
			</div>
			<div>
				<pagination :data="datas" @pagination-change-page="getResults"></pagination>
			</div>
		</div>
		<div class="col-lg-4">
			<br>
			<div class="under_line">
				<div style="border-radius: unset;outline: none;background: #574BFC" class="heading-new btn btn-primary">Top thảo luận</div>
			</div>
			<br>
				<ItemForum
				v-for="(v,i) in covertTitle"
				:key="i"
				:value="v">
				</ItemForum>
			<br>
			<div class="under_line">
				<div style="border-radius: unset;outline: none;" class="heading-new btn btn-danger">Chủ đề</div>
			</div>
			<br>
			<ul class="list__cate--forum">
				<template>
					<li class="item__cate--forum"></li>
				</template>
				<li v-for="value in cate_data" class="item__cate--forum">
					<router-link tag="a" class="link_forum" style="display: block;font-size: 1.1rem;" :to="{ path: '/forum/thread/'+value.id_cate}">{{value.name_cate}}</router-link>
					<span>Tổng bài viết :{{value.sum_post}} </span>
					<span>Mới nhất :{{value.title_post}} </span>
				</li>
			</ul>
			
		</div>
	</div>
</div>
</template>

<script>
import ItemForum from './ItemForum';
export default {
  name: 'ForumComponent',
  components:{
  	ItemForum
  }
  ,
  data () {
    return {
    	page:1,
    	elem:8,
    	turn:4,
    	width:1,
    	user:1,
    	datas:{},
    	cate_data:[],
    	new_data:[],
    	load:true
    }
  },
  mounted(){
  	
  		
  },
  created(){
  	this.page= this.$route.query.page;
    	this.loadForum(); 
    	this.process();
  },
  updated(){
  		document.title = "Diễn đàn thảo luận";
		this.page= this.$route.query.page;
		$('.item_forum').each(function(i, el) {
	       if (i % 2 === 0) {

	        $(this).addClass('blue_light');
	       }else{
	        $(this).addClass('gray_light');
	       }
		});
		this.load=false;
  },
  computed:{
  	covertTitle(){
  		return this.new_data.map((el,index)=> {
  			if(el.title_post.length>22){
  				el.title_post=el.title_post.slice(0,22)+'...';
  				return el;
  			}
  				return el;
  		})
  	}

  },
  methods:{
    	loadForum:function() {
    		this.getResults();
    		axios.get('api/forum')
    		.then((rep)=>{
    			this.cate_data=rep.data.cate_forum;
    			this.new_data=rep.data.data_new;
    			this.user=rep.data.user;
    			console.log();
    		})
    		.catch((e)=>{
    			console.log(e);
    		})
    	},
    	getResults:function(page) {
	        if (typeof this.$route.query.page === 'undefined') {
	            page = 1;
	        }
	        console.log(page);
	        this.page=page;
	        axios.get('api/forum?page='+this.page)
    		.then((rep)=>{
    			this.datas=rep.data.data;
    			this.page=rep.data.data.current_page;
    			history.pushState({}, '', 
                `./#/forum?page=${this.page}`);
    		})
    		.catch((e)=>{
    			console.log(e);
    		})
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
    }
}

</script>
<style lang="css" scoped>
</style>