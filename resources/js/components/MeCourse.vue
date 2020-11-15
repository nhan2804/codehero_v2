<template>
	<div class="container">
		<br>
		<br>
		<br>

	<div class="row">
		<h3 class="col-lg-12">Khóa học của tôi</h3>
	<article v-for="(v,i) in convertCourse" class="course-item col-xs-6 col-md-4 col-lg-3 mb-4">
			<div class="border_course">
				<div class="wrap-course-item">
					<div class="course-thumb">
						<!-- <a href="{{URL::to('/course/post/'.v->id_course)}}" title="{{v->title_course}}"> -->
							<img style="width: 100%;height: 170px;" :src="'public'+v.img_course" :alt="v.title_course">
						<!-- </a> -->
					</div>
					<div class="view-content">
						<h3 class="course-title"><a>{{v.title_course}}</a></h3>
						<div v-html="v.desc_course" class="wrap_desc">
							
						</div>
						<br>
						<div class="user-rating">
							<a class="btn btn-success">Học</a>
							<span class="star-rating"><span style="width:90.0%"></span></span>
						</div>
					</div>
				</div>
			</div>
		</article>
	</div>
	</div>
</template>

<script>
export default {

  name: 'MeCourse',
  created(){
  	this.loadCourse();
  },
  data () {
    return {
    	courses:[]
	}
  },
	computed:{
  			convertCourse(){
  			return this.courses.map((el,index)=>{
  				if(el.desc_course.length>80){
					el.desc_course=el.desc_course.slice(0,80)+'...</p>';
					return el;
	  			}else{
	  				return el;
	  			}
  			});
  		}
  },
  methods:{
  	loadCourse:function() {
  		console.log('testđ');
		axios.get('api/me/course')
		.then((resp)=>{
			this.courses=resp.data;

		})
		.catch((e)=>{
			console.log(e);
		})
	}
  },
}
</script>

<style lang="css" scoped>
</style>