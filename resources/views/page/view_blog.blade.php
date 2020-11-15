
@extends('welcome')
@section('title',$data->title_blog)
@section('content')
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
											<?php
												$id_blog = $data->id_blog;
												$time_up= $data->created_at;
												$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
											?>
												<span>Tác giả</span>
												<img class="img_auth" src="{{asset($data->avatar)}}">
                                                <span class="author-name"><a href="#">{{$data->displayname}}</a></span>
                                                <span class="time-icon"><i class="fa fa-circle"></i></span>
                                                <span id="create-time" class="time"><?php echo substr($time_up,0,10)?></span>
                                            </div>
                                            <div class="col-sm-5 text-right" style="position: relative; top:20px">
                                                <span class="comment-icon"><i class="fa fa-eye"></i></span>
                                                <span class="comment-text total-view">{{$data->view_blog}}</span>
                                                <span class="comment-icon"><i class="fa fa-share-alt"></i></span>
                                                <span class="comment-text">0</span>
                                            </div>
                                        </div>
                                        <div class="row main-content">
                                            <div class="col-md-12">
                                                <div class="main-image">
                                                    <img  src="{{asset('public'.$data->img_blog)}}" alt="{{$data->title_blog}}">
                                                </div>
                                                <div class="blog-content">
                                                    <h1>{{$data->title_blog}}</h1>
                                                    <div class="content">
														<p>{!!$data->content_blog!!}</p>                                                                                                              
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row sharing">
                                            <div class="col-sm-6 text-left tag-lists">
                                                <?php
                                                $tags= explode(';',$data->tag_blog);
                                                for ($i=0; $i <count($tags) ; $i++) { 
                                                    echo '<a href="#" class="tag-list" title="'.$tags[$i].'">'.$tags[$i].'</a>';
                                                }
                                                ?>
                                            </div>
                                            <div class="col-sm-6 text-right socials-share">
												<a class="bg-facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo($url)?>" target="_blank"><i class="fab fa-facebook-f"></i> Share</a>
												<a class="bg-twitter" href="https://twitter.com/share?text=<?php echo urlencode($data->title_blog); ?>&url=<?php echo($url)?>" target="_blank"><i class="fab fa-twitter"></i> Tweet</a>
												<a class="bg-google-plus" href="https://plus.google.com/share?url=<?php echo($url)?>" target="_blank"><i class="fas fa-plus"></i> Plus</a>
												<a class="bg-pinterest" href="" target="_blank"><i class="fab fa-pinterest-p"></i> Pin</a>
                                                <a class="bg-email" href="" target="_blank"><i class="fas fa-envelope"></i> Gmail</a>
                                                <a class="bg-messenger" href="" target="_blank"><i class="fab fa-facebook-messenger"></i> Messenger</a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="comment-area">
                                                    <div class="user-rating">
                                                        <div class="user-action-buttons">
                                                            <span class="likeButton">
                                                                <img src="../../../../img/Like.svg" class="up" id="img_1847944">
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
																{{ csrf_field()}}
																	@if(Session::get('id'))
																			<div class="comment">
																				<div class="user-avatar">
																				
																					<img style="width: 100%" class="avatars" src="{{asset(Session::get('img'))}}" alt="">
																					<h3 class="name_auth">{{Session::get('name')}}</h3>
																				</div>
																				<div class="edit-box comment-box">
																					<textarea placeholder="Viết bình luận của bạn" class="with-placeholder" name="cmt" id="cmt_input"></textarea>                                 
																						<div class="waiting-indicator">
																							<span class="glyphicon glyphicon-refresh"></span>
                                                                                        </div>
                                                                                        <input class="submit-cmmt btn btn-success" title="Đăng" data-id="{{$id_blog}}" id="cmt_blog" type="submit" value="Bình luận">
                                                                                </div>
                                                                            </div>
																			<div class="comment-message" id="top-comment-message"></div>
																	@else
																		<h3 left_cmt>Đăng nhập để bình luận</h3>
                                                                    @endif
															</form>                                                                                                                                                                                                                                   
														</div>
														<div>
                                                        <!-- chỗ này bà cần coi lại nhé, mở ra nó bị thiếu thẻ đóng -->
															<!-- <div class="comment-block" style="display: block;">
																@foreach($cmts as $key =>$value)
																<div class="div_comment" style="margin: 20px 0;">
																	<div class="user-avatar">
																		<div class="avatars">
																			<img class="avatars" src="{{asset($value->avatar)}}" alt="">																
																		</div>
																	</div>
																	<div class="comment-main">
                                                                		<div class="comment-user">
																			<a href="#" class="href-user">{{$value->displayname}}</a>
																			<span class="modified-time">{{$value->updated_at}}</span>
																		</div>
																		<span class="comment-content">{{$value->content_cmt}}</span>
																		<div class="comment-message for-edit error"></div>                         
																			<div class="view-more">Xem thêm</div>                         
																			<div class="comment-footer">                           
																				<div class="left-parts action-buttons">
																					<span class="hide-message">Bình luận này đã bị ẩn </span>
																					<div class="user-action-buttons">
																						<span class="likeButton">
																							<img src="../../../../img/Like.svg" class="up" id="img_1903053"> 
																							<span id="countVoteLike_1903053" class="count-vote"> 0</span>
																						</span>
																						<span class="disLikeButton">
																							<img src="../../../../img/dislike.svg" class="down" id="imgDisLike_1903053">
																							<span id="countVoteDisLike_1903053" class="count-vote"> 0</span> 
																						</span>
																						<span class="footer-button reply-button">
																							<img src="../../../../img/reply.svg" class="reply-img">Trả lời
																						</span>
																					</div>
																					<span class="big-dot">●</span>
																					<span class="footer-button hide-button">Ẩn</span>
																					<span class="big-dot">●</span>
																					<span class="footer-button edit-button">Sửa</span>
																					<span class="big-dot">●</span>
																					<span class="footer-button delete-button">Xoá</span>
																				</div>                           
																				<div class="right-parts">
																					<button class="btn btn-success standard-button save-button" style="display: none;">Lưu</button> 
																				</div>                        
																			</div>                         
																			<div class="replies"></div>                         
																			<div class="edit-box reply-box" style="display: none;">                           
																				<div placeholder="Viết bình luận của bạn" class="with-placeholder" id="comment-box" contenteditable="">
                                                                                </div>  
																				<div class="waiting-indicator">
																					<span class="glyphicon glyphicon-refresh"></span>
																				</div>
																				<a href="#" class="submit-cmmt btn" title="Đăng"> Đăng</a>
																			</div>                         
																			<div class="comment-message"></div>                       
																		</div>                                                                            
																	</div>
																</div>
																@endforeach
															</div>
															 -->
                                                            </div>
                                                            </div>
                                                    </div>
                                                    </div>
                                                    </div>
                                                    </div>
                                            <div class="related-items">
                                                <b class="related">Bài viết liên quan</b>
                                                @foreach($next_blog as $k=>$v)
                                                    <div id="related-items" class="list">
                                                        <div class="item">
                                                            <div class="row">
                                                                <div class="col-sm-3 image">
                                                                    <a href="#">
                                                                        <img src="{{asset('public'.$v->img_blog)}}" alt="{{$v->title_blog}}">
                                                                    </a>
                                                                </div>
                                                                <div class="col-sm-9 info">
                                                                    <div class="top">
                                                                        <h3>
                                                                            <a title="{{$v->title_blog}}" href="{{$v->id_blog}}">{{$v->title_blog}}</a>
                                                                        </h3>
                                                                        <div class="user-rating pull-right">
                                                                            <div class="user-rating">
                                                                                <span class="star-rating">
                                                                                    <span style="width:80.0%"></span>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                    </div>
                                                                    <div class="bottom">
                                                                        <div class="row tag-list">
                                                                            <div class="col-md-12 tag-scroll">
                                                                            <?php
                                                                            $tags= explode(';',$v->tag_blog);
                                                                            for ($i=0; $i <count($tags) ; $i++) { 
                                                                                echo '<span><a href="#">'.$tags[$i].'</a></span>';
                                                                            }
                                                                            ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="author">
                                                                            <span>Tác giả:</span>
                                                                            <a title="" href="#">
                                                                                <span class="author-name">Boman</span>
                                                                            </a>
                                                                            <span class="time-icon"><i class="fa fa-circle"></i></span>
                                                                            <span class="time">{{$v->updated_at}}</span>
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
                                                @endforeach
                                            </div>
                                                    </div>

                                        <div class="col col-md-3 col-sm-12 col-12 sidebar">
                                            <div class="block author-info">
                                                <h3>Tác giả</h3>
                                                <div class="author">
                                                    <div class="avatar">
                                                        <img id="owner-user-avatar" class="user-avatar" src="{{asset($data->avatar)}}">
                                                    </div>
                                                    <div class="user-name">
                                                        <a id="owner" href="#" title="{{$data->displayname}}">{{$data->displayname}}</a>
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
                                                        <li style="text-align: left;">
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
                                                @foreach($refer_blog as $key=>$value)
                                                    <div class="list-items">
                                                        <div class="item">
                                                            <a href=" {{$value->id_blog}}" title=" {{ $value->title_blog}}">
                                                                <img src="{{asset('public'.$value->img_blog)}}" alt=" {{ $value->title_blog}}">
                                                            </a>
                                                            <a title="{{$data->title_blog}}" href=" {{$value->id_blog}}"> {{ $value->title_blog}}</a>
                                                        </div>
                                                    </div>                                  
                                                @endforeach
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
@endsection
