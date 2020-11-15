<template>
	<div class="container-fluid bg_course">
		<br>
		<br>		<br>
	<div class="container mobile-container p-0">
		<div id="list">
			<section class="list-courses">
				<div class="row">
					<h2 class="col-12" style="font-size: 28px">{{cate.name}}</h2>
					<article v-for="value in convertCourse" class="course-item col-xs-6 col-md-4 col-lg-3">
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
				</div>
			</section>
		</div>
	</div>
	</div>
</template>

<script>
export default {

  name: 'CateCourse',

  data () {
    return {
    	datas:[],
    	id:this.$route.params.id,
    	cate:{}
    }
  },
  computed:{
  		convertCourse(){
  			return this.datas.map((el,index)=>{
  				if(el.desc_course.length>80){
  				el.desc_course=el.desc_course.slice(0,80)+'...</p>';
  				el.slug= "ok-ok";
  				return el;
	  			}else{
	  				el.slug="ok-ok";
	  				return el;
	  			}
  			});
  		}
  },
  created(){
  	this.loadCateCourse(); 
  },
  updated(){
  	
  },
   methods:{
  	loadCateCourse:function() {
    		axios.get('api/course/category/'+this.id)
    		.then((rep)=>{
    			this.datas=rep.data.datas;
    			this.cate=rep.data.cate;

    		})
    		.catch((e)=>{
    			console.log(e);
    		})
    	}
  },
  watch: {
    $route() {
        this.id=this.$route.params.id;
        this.loadCateCourse();
    }
}
}
</script>

<style lang="css" scoped>
</style>