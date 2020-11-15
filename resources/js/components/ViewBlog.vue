<template>
	<div>
		<br>
		<br>
		<br>
	<div id="layout-main" class="group">
        <div id="layout-content" class="group">
            <div id="content" class="group">
                <div class="zone zone-content">
                    <div class="container">
                        <div class="blog-detail">
                            <div class="row">
                                <div class="col col-md-9 col-sm-12 col-12 main-blog">
                                    <div class="wrapper">
                                        <div class="row author">
                                            <div class="col-sm-7 text-left">
												<span>Tác giả</span>
												<img class="img_auth" alt="?" :src="'./'+datas.avatar">
                                                <span class="author-name"><a href="#">{{datas.displayname}}</a></span>
                                                <span class="time-icon"><i class="fa fa-circle"></i></span>
                                                <span id="create-time" class="time">{{datas.created_at}}</span>
                                            </div>
                                            <div class="col-sm-5 text-right" style="position: relative; top:20px">
                                                <span class="comment-icon"><i class="fa fa-eye"></i></span>
                                                <span class="comment-text total-view">{{datas.view_blog}}</span>
                                                <span class="comment-icon"><i class="fa fa-share-alt"></i></span>
                                                <span class="comment-text">0</span>
                                            </div>
                                        </div>
                                        <div class="row main-content">
                                            <div class="col-md-12">
                                                <div class="main-image">
                                                    <img  :src="'./public'+datas.img_blog" alt="loi">
                                                </div>
                                                <div class="blog-content">
                                                    <h1>{{datas.title_blog}}</h1>
                                                    <div v-html="datas.content_blog" class="content">
														
													</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row sharing">
                                            <div class="col-sm-6 text-left tag-lists">
                                               
                                            </div>
                                            <div class="col-sm-6 text-right socials-share">
												<a class="bg-facebook" href="https://www.facebook.com/sharer/sharer.php?u=" target="_blank"><i class="fab fa-facebook-f"></i> Share</a>
												<a class="bg-twitter" href="https://twitter.com/share?text=" target="_blank"><i class="fab fa-twitter"></i> Tweet</a>
												<a class="bg-google-plus" href="https://plus.google.com/share?url=" target="_blank"><i class="fas fa-plus"></i> Plus</a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="comment-area">
                                                    <div class="user-rating">
                                                        <div class="user-action-buttons">
                                                            <span class="likeButton">
                                                                <img src="public/images/like.svg"  alt="err"class="up" id="img_1847944">
                                                                <span id="countVoteLike_1847945" class="count-vote"> 1</span>
                                                            </span>
                                                            <span class="footer-button reply-button">
                                                                <i class="fa fa-share-alt"></i>
                                                                <span id="countVoteShare_1847945" class="count-vote">0</span> 
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div id="container-comment" class="loaded-all">
                                                        <div class="total-comments-section">
                                                            <span id="total-comments">0</span> Bình luận
                                                        </div>
                                                        <div class="top-level-comment-input">
															<form onsubmit="return false">
																<div class="comment">
																	<!-- <div class="user-avatar">
																	
																		<img style="width: 100%" class="avatars" src="{{asset(Session::get('img'))}}" alt="">
																		<h3 class="name_auth">{{Session::get('name')}}</h3>
																	</div> -->
																	<div class="edit-box comment-box">
																		<textarea placeholder="Viết bình luận của bạn" class="with-placeholder" name="cmt" id="cmt_input"></textarea>                                 
																			<div class="waiting-indicator">
																				<span class="glyphicon glyphicon-refresh"></span>
                                                                            </div>
                                                                            <input class="submit-cmmt btn btn-success" title="Đăng" data-id="" id="cmt_blog" type="submit" value="Bình luận">
                                                                    </div>
                                                                </div>
																<div class="comment-message" id="top-comment-message"></div>
														<!-- @else -->
                                                        <!-- @endif -->
															</form>                                           
														</div>
														
                                                    </div>
                                                    </div>
                                                    </div>
                                                    </div>
                                                    </div>
                                            <div class="related-items">
                                                <b class="related">Bài viết liên quan</b>
                                                <!-- @foreach($next_blog as $k=>$v) -->
                                                    <div v-for="value in next_blog" id="related-items" class="list">
                                                        <div class="item">
                                                            <div class="row">
                                                                <div class="col-sm-3 image">
                                                                    <a href="#">
                                                                        <img src="" alt="error">
                                                                    </a>
                                                                </div>
                                                                <div class="col-sm-9 info">
                                                                    <div class="top">
                                                                        <h3>
                                                                            <a href="link">{{value.title_blog}}</a>
                                                                        </h3>
                                                                        <div class="user-rating pull-right">
                                                                            <div class="user-rating">
                                                                                <span class="star-rating">
                                                                                    <!-- <span style="width:80.0%"></span> -->
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                    </div>
                                                                    <div class="bottom">
                                                                        <div class="row tag-list">
                                                                            <div class="col-md-12 tag-scroll">
                                                                            
                                                                            </div>
                                                                        </div>
                                                                        <div class="author">
                                                                            <span>Tác giả:</span>
                                                                            <a title="" href="#">
                                                                                <span class="author-name">Boman</span>
                                                                            </a>
                                                                            <span class="time-icon"><i class="fa fa-circle"></i></span>
                                                                            <span class="time">{{value.created_at}}</span>
                                                                            <span class="comment-icon"><i class="fa fa-eye"></i></span>
                                                                            <span class="comment-text total-view">553</span>
                                                                            <span class="comment-icon"><i class="fa fa-share-alt"></i></span>
                                                                            <span class="comment-text">5</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                               <!--  @endforeach -->
                                            </div>
                                                    </div>

                                        <div class="col col-md-3 col-sm-12 col-12 sidebar">
                                            <div class="block author-info">
                                                <h3>Tác giả</h3>
                                                <div class="author">
                                                    <div class="avatar">
                                                        <img id="owner-user-avatar" class="user-avatar" :src="'./'+datas.avatar" alt="err">
                                                    </div>
                                                    <div class="user-name">
                                                        <a id="owner" href="#">{{datas.displayname}}</a>
                                                    </div>
                                                    <p id="company-owner"> - </p>
                                                    <div>
                                                        <a href="#" id="total-post" class="total-post">17 bài viết</a> |
                                                        <span id="total-follow">17</span> 
                                                        <span class="follower-text">người theo dõi</span>
                                                    </div>
                                                    <div>
                                                        <button id="follow" value="0" type="button" class="btn btn-info">
                                                            <i class="fa fa-wifi"></i> Theo dõi
                                                        </button>
                                                    </div>
                                                    <ul id="achievement-owner">
                                                        <li>
                                                            <i class="fa fa-check-circle" style="position: relative;"></i>
                                                            <span>Best Dev In The World</span>
                                                        </li>
                                                    </ul>                                       
                                                    <span id="more-achievement" class="hide">Xem thêm</span>
                                                    <div class="social-network">
                                                        <a id="facebook" target="_blank" href="#" class="">
                                                            <i class="fab fa-facebook-f" ></i>
                                                        </a>
                                                        <a id="twitter" href="javaScript:void(0)" class="not-allowed">
                                                            <i class="fab fa-twitter-square"></i>
                                                        </a>
                                                        <a id="linkedIn" href="javaScript:void(0)" class="not-allowed">
                                                            <i class="fab fa-linkedin"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="block related-owner">
                                                <h3>Bài viết cùng tác giả</h3>
                                                    <div v-for="value in refer_blog" :key="Math.random()" class="list-items">
                                                        <div class="item">
                                                            <a href="link" title="">
                                                                <img :src="'./public'+value.img_blog" alt=" loi">
                                                            </a>
                                                            
                                                            <router-link tag="a" :to="{ path: '/blog/'+value.id_blog}">{{value.title_blog}}</router-link>
                                                        </div>
                                                    </div>                    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                    
                    </div> 
                </div>
            </div>
        </div>
        </div>
        </div>
        </div>
    </div>
    </div>
</template>
<script>
export default {

  name: 'ViewBlog',
  data () {
    return {
    	datas:{},
    	cmts:[],
    	next_blog:[],
    	refer_blog:[],
    	title:'',
    	id:this.$route.params.id
    }
  },
  mounted(){
        this.loadView();
  },
  updated() {
        document.title = this.datas.title_blog;
   },
  created(){

  },
  methods:{
    	loadView:function() {
    		axios.get('api/blog/'+this.id)
    		.then((resp)=>{
    			this.datas=resp.data.data;
    			this.cmts=resp.data.cmts;
    			this.next_blog=resp.data.next_blog;
    			this.refer_blog=resp.data.refer_blog;
    			this.title=resp.data.data.title_blog;
    		})
    		.catch((e)=>{
    			console.log(e);
    		})
    	}
    },
    watch: {
    $route() {
        this.id=this.$route.params.id;
        this.loadView();
    }
}
}
</script>

<style lang="css" scoped>
h1{
	color:red;
}
</style>