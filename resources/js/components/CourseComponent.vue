<template>
	<div class="container-fluid bg_course">
		<br>
		<br>
	        <div class="head-course hide-on-mobile">
	            <img src="public/images/banner1.png" style="width: 100%">
	            <div id="search" class="block-top-head">
	                <div class="input-group">
	                    <form id="form-search" action="/learning?">
	                        <span class="fa fa-search"></span>
	                        <input Name="name" id="search-course" type="text" class="form-control" placeholder="Nhập nội dung tìm kiếm">
	                    </form>
	                </div>
	            </div>
			</div>
		<div class="container mobile-container p-0">
			<div id="list">
				<section class="list-courses">
					<div class="row">
						<template v-for="value in convertCourse">
							<template v-if="value.id_cate!=id">
						    	<div class="col-lg-12">
						    		<h2 class="title-block">{{value.name}}</h2>
						    	</div>
					    	</template>
					    {{setId(value.id_cate)}}
						<article class="course-item col-xs-6 col-md-4 col-lg-3">
							<div class="border_course">
								<div class="wrap-course-item">
									<div class="course-thumb">
										<router-link tag="a" :to="{ path: '/course/' + value.id_course +'/'+value.slug}">
											<img style="width: 100%;height: 170px;" :src="'public'+value.img_course" :alt="value.title_course">
										</router-link>
										<div class="timeCouter">
											<span class="time">18:00:00</span>
										</div>
									</div>
									<div class="view-content">
										<h3 class="course-title"><router-link tag="a" :to="{ path: '/course/' + value.id_course +'/'+value.slug}">{{value.title_course}}</router-link></h3>
										<div v-html="value.desc_course" class="wrap_desc">
											
										</div>
										<br>
										<div class="user-rating">
											<div class="course-info">
												<span class="lession-count"><i class="fa fa-desktop"></i>55</span>
												<span class="student-count"><i class="fas fa-user-alt"></i>2271</span>
											</div>
											<span class="star-rating"><span style="width:90.0%"></span></span>
										</div>
									</div>
									<div class="badge">
										<span class="name_badge">Khóa mới</span>
									</div>
								</div>
							</div>
						</article>
					</template>
					</div>
				</section>
			</div>
		</div>
	</div>
</template>
<script>
export default {
  name: 'CourseComponent',

  data () {
    return {
    	elem:8,
    	turn:4,
    	width:1,
    	course:[],
    	id:99999,
    	load:true
    }
  },
  updated(){
  	document.title = "Khóa học";
  	this.load=false;
  },
   mounted(){
    	this.loadCourse();
    	this.process();
  },
  created(){
  	// this.loadCourse();
  },
  computed:{
  		convertCourse(){
  			return this.course.map((el,index)=>{
  				if(el.desc_course.length>80){
  				el.desc_course=el.desc_course.slice(0,80)+'...</p>';
  				el.slug= this.slug(el.title_course);
  				return el;
	  			}else{
	  				el.slug= this.slug(title_course);
	  				return el;
	  			}
  			});
  		}
  },
  methods:{
		  slug:(str)=>{
		    var slug;
		    slug = str.toLowerCase();
		    slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
		    slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
		    slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
		    slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
		    slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
		    slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
		    slug = slug.replace(/đ/gi, 'd');
		    slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
		    slug = slug.replace(/ /gi, "-");
		    slug = slug.replace(/\-\-\-\-\-/gi, '-');
		    slug = slug.replace(/\-\-\-\-/gi, '-');
		    slug = slug.replace(/\-\-\-/gi, '-');
		    slug = slug.replace(/\-\-/gi, '-');
		    slug = '@' + slug + '@';
		    slug = slug.replace(/\@\-|\-\@|\@/gi, '');
		    return slug;
		},
    	loadCourse:function() {
    		axios.get('api/course')
    		.then((rep)=>{
    			this.course=rep.data;
    		})
    		.catch((e)=>{
    			console.log(e);
    		})
    	},
    	setId:function(id) {
    		this.id=id;
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