@extends('frontend/layout/master')
@section('style-bot')
{{ HTML::style('public/assets/css/albums-images/view.css') }}
{{ HTML::style('public/assets/css/albums/view.css') }}
@stop
@section('script-bot')
{{ HTML::script('public/assets/js/albums/jquery-ui-1.10.3.custom.min.js') }}
{{ HTML::script('public/assets/js/albums/jquery.kinetic.min.js') }}
{{ HTML::script('public/assets/js/albums/jquery.mousewheel.min.js') }}
{{ HTML::script('public/assets/js/albums/jquery.smoothdivscroll-1.3-min.js') }}
{{ HTML::script('public/assets/js/albums-images/view.js') }}
{{ HTML::script('public/assets/js/albums/view.js') }}
@stop
@section('width_70per')
	width_70per
@stop
@section('title')
	Image Viewer
@stop
@section('content')

	<div class="image_content row">
		<div class="image_left col-md-8">
			@foreach($album->images as $index => $image)
            <article>
                <div class="detail_image_header">
                    <h2 class="detail_image_title">{{$image->title}}</h2>
                </div>
                <ul class="detail_image_info">
                    <li class="detail_image_info_date"><span >{{$image->updated_at}}</span></li>
                    <li class="detail_image_info_count_like"><span class="like"><i class="glyphicon glyphicon-heart"></i> {{$image->count_like}}</span></li>
                    <li class="detail_image_info_count_share"><span class="share"><i class='glyphicon glyphicon-share'></i> {{$image->count_share}}</span></li>
                </ul>
                <div class="photo_content">
                    <a href='{{Asset('image/view/'.$image->id)}}'>
                        <img class="img-rounded image-view" src="{{url('public/'.$image->path)}}" alt="{{$album->title}}">
                    </a>
                    <p>
                        <label class="caption">Caption: </label>
                        <span>{{$image->caption}}</span>
                    </p>
                </div>
            </article>
            @endforeach
		</div>
		<div class="image_right col-md-4">
			<ul>
				<li>
					<p>ĐĂNG BỞI</p>
					<p>
                        <a href="#" class="user_name">{{$album->user->name}}</a>
                        <input type='hidden' id='user_id' value='{{$image->album->user->id}}'>
                        <input type='hidden' id='current_user' value='{{Session::get('current_user')}}'>
                        @if($image->album->user->id != Session::get('current_user'))
                            @if ($current_user->follow($album->user->id) == 0)
                                <button class="btn btn-success follow-btn" itemid='{{url('/user/ajax-follow')}}'>Follow</button>
                                <button class="btn btn-success unfollow-btn" itemid='{{url('/user/ajax-unfollow')}}' style='display: none'>Unfollow</button>
                            @elseif ($current_user->follow($album->user->id) == 1)
                            <button class="btn btn-success follow-btn" itemid='{{url('/user/ajax-follow')}}' style='display: none'>Follow</button>
                                <button class="btn btn-success unfollow-btn" itemid='{{url('/user/ajax-unfollow')}}'>Unfollow</button>
                            @endif
                        @endif
                        
                    </p>
				</li>
				<li>
					<p>GIỚI THIỆU</p>
					<p>{{ $album['description'] }}</p>
				</li>
				<li>
					<p>CHUYÊN MỤC</p>
					<p>{{ $album->category->title}}</p>
				</li>
                @if(Session::has('current_user'))
				<li>
					<p>BÌNH LUẬN</p>
                    <textarea class="form-control" placeholder="Viết bình luận của bạn..."></textarea>
				</li>
				<li>
					<button class="btn btn-danger">Bình luận</button>
				</li>
                @else
                <li>
                    <p>(Đăng nhập để có thể bình luận ...)</p>
                </li>
                @endif
                <li>
                    <div class="detailBox">
                        <div class="titleBox">
                            <label>Comment Box</label>
                            <span>(Click để thu gọn)</span>
                        </div>
                        <div class="actionBox">
                            <ul class="commentList">
                                <li>
                                    <div class="commenterImage">
                                      <img src="http://lorempixel.com/50/50/people/6" />
                                    </div>
                                    <div class="commentText">
                                        <p class="">Hello this is a test comment.</p> <span class="date sub-text">on March 5th, 2014</span>

                                    </div>
                                </li>
                                <li>
                                    <div class="commenterImage">
                                      <img src="http://lorempixel.com/50/50/people/7" />
                                    </div>
                                    <div class="commentText">
                                        <p class="">Hello this is a test comment and this comment is particularly very long and it goes on and on and on.</p> <span class="date sub-text">on March 5th, 2014</span>

                                    </div>
                                </li>
                                <li>
                                    <div class="commenterImage">
                                      <img src="http://lorempixel.com/50/50/people/9" />
                                    </div>
                                    <div class="commentText">
                                        <p class="">Hello this is a test comment.</p> <span class="date sub-text">on March 5th, 2014</span>

                                    </div>
                                </li>
                                <li>
                                    <div class="commenterImage">
                                      <img src="http://lorempixel.com/50/50/people/8" />
                                    </div>
                                    <div class="commentText">
                                        <p class="">Hello this is a test comment.</p> <span class="date sub-text">on March 5th, 2014</span>

                                    </div>
                                    <li>
                                    <div class="commenterImage">
                                      <img src="http://lorempixel.com/50/50/people/10" />
                                    </div>
                                    <div class="commentText">
                                        <p class="">Hello this is a test comment.</p> <span class="date sub-text">on March 5th, 2014</span>

                                    </div>
                                </li>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
			</ul>
		</div>
	</div>

@stop
