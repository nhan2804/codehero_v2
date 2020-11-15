<template>
<div class="container">
		<br>
        <br>
        <br>
    <div style="display: flex;justify-content:space-between;margin: 24px -10px 10px -10px">
		<span></span>
		<form style="width: 300px;display: block;position: relative;border:1px solid #000">
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
	<div class="body_load" v-if="load" >
		<div style="margin: 0 -10px" class="img_head hide-on-table-and-moblie">
			<div class="div_small-blog" style="width:100%;height:300px;"></div>
		</div>
		<br>
        <div style="width:100%" class="row">
        	<div class="col-lg-3 gutter-6">
        		<div class="div_small-blog"></div>
        		<div class="div_small-blog"></div>
        		<div class="div_small-blog"></div>
        		<div class="div_small-blog"></div>
        		<div class="div_small-blog"></div>
        	</div>
        	<div class="col-lg-5 gutter-6">
        		<div class="div_medium-blog"></div>
        		<div class="div_medium-blog"></div>
        		<div class="div_medium-blog"></div>
        		<div class="div_medium-blog"></div>
        	</div>
        	<div class="col-lg-4 gutter-6">
        		<div class="div_lagrge-blog"></div>
        		<div class="div_lagrge-blog"></div>
        		<div class="div_lagrge-blog"></div>
        		<div class="div_lagrge-blog"></div>
        	</div>
        </div>
    </div>
	
	<div style="margin: 0 -10px" class="img_head hide-on-table-and-moblie">
	 <img src="public/images/ShareWall.png" alt="" />
	</div>
	<br class="hide-on-table-and-moblie">
	<br>	
		<div class="row">
			<div class="col-5 col-lg-3 col-sm-5 gutter-6">
				<div v-for="value in blog" style="margin-bottom: 12px;" class="div__blog--hover item_small_blog">
					<div :style="{backgroundImage:'url(public/'+value.img_blog+')'}"  style="background-position: center;background-size: cover; height: 120px;border: 1px solid #ccc"></div>
					<div class="info_blog">
							<span v-for="i in rank">
								<div class="blog_rank">
									{{ i.index++}}
								</div>
							</span>
						<div class="blog_name" style="flex: 1">
							<span v-bind:style="{backgroundColor:value.color_cate}" class="blog_cate">{{value.name}}</span>
							<router-link tag="a" class="title__blog--link" :to="{ path: '/blog/' + value.id_blog}">{{value.title_blog}}</router-link>
						</div>
					</div>
				</div>
			</div>
			<div class="col-7 col-lg-5 col-sm-7 gutter-6">
				<div class="item_big_blog">
					<div v-for="value in blog1" class="div__blog--hover" :style="{backgroundImage:'url(public/'+value.img_blog+')'}" style="background-position: center;background-size: cover; height: 230px;margin-bottom: 12px;position: relative;">
						<div class="item_meta">
							<span class="item_cate" v-bind:style="{backgroundColor:value.color_cate}">{{value.name}}</span>
							<span class="item_date">/ {{value.created_at}}</span>
							<router-link tag="a" class="item_link" :to="{ path: '/blog/' + value.id_blog}"><h3>{{value.title_blog}}</h3></router-link>
						</div>	
					</div>
				</div>
			</div>
			<div class="col-12 col-lg-4 col-sm-12 gutter-6 ">
				<div class="item_big_blog horizontal">
					<div  v-for="value in blog2" class="div__blog--hover div_blog_medium" :style="{backgroundImage:'url(public/'+value.img_blog+')'}" style=";background-position: center;background-size: cover; ">
						<div class="item_meta">
							<span class="item_cate" v-bind:style="{backgroundColor:value.color_cate}">{{value.name}}</span>
							<span class="item_date">/ {{value.created_at}}</span>
							<router-link tag="a" class="item_link item_link_cus" :to="{ path: '/blog/' + value.id_blog}"><h3>{{value.title_blog}}</h3></router-link>
						</div>	
					</div>
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
					<div v-for="value in new_blog" :key="value.id_blog" class="row mb-3">
						<div class="col-lg-5 col-md-5 col-sm-12 col-12">
							<div :style="{backgroundImage:'url(public/'+value.img_blog+')'}" style="background-position: center;background-size: cover; height: 180px;padding: 4px 0;"></div>
						</div>
						<div class="col-lg-7 col-md-7 col-sm-12 col-12">
							<div>
								<span v-bind:style="{backgroundColor:value.color_cate}" class="blog_cate">{{value.name}}</span>
								<router-link tag="a" class="item_link" :to="{ path: '/blog/' + value.id_blog}"><h3 style="color: #333;font-weight: 490;margin: 6px 0">{{value.title_blog}}</h3></router-link>
								<span style="color: #333;" class="item_date">2 Xem</span>
								<div v-html="value.content_blog" class="div_conten-blog">	
								</div>
							</div>
						</div>
					</div>
				</div>
				<input type="hidden" id="row_curr" value="5" name="">
					<div style="display: flex;justify-content: center;">
						<button id="see_more" style="border-radius: unset;outline: none;" class="btn btn-primary ">Xem thêm</button>
					</div>
			</div>
			<div class="col-md-4 col">
				<div class="hide-on-table-and-moblie">
					<img src="public/images/banner7.png" style="width: 16em; margin-left: 7em" class="banner_shadow"/>
				</div>
			</div>
	</div>
</div>
</template>

<script>
export default {

  name: 'BlogComponent',

  data () {
    return {
    	elem:8,
    	turn:4,
    	width:1,
    	blog:[],
    	blog1:[],
    	blog2:[],
    	new_blog:[],
		load:true,
		rank:[
			{index: -1004},
		]
    }
  },
  updated(){
  	this.load=false;
  	
  },
  mounted(){
    	this.loadBlog();
    	this.process();
  },
  created(){

  },
  methods:{
    	loadBlog:function() {
    		axios.get('api/blog')
    		.then((rep)=>{
    			this.blog=rep.data.datas.splice(0,5);
    			this.blog1=rep.data.datas.splice(0,4);
    			this.blog2=rep.data.datas;
    			this.new_blog=rep.data.blog_new;
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