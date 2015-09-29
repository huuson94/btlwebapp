@extends('frontend/layout/master')
@section('style-bot')
{{ HTML::style('public/assets/css/images/view.css') }}
@stop
@section('script-bot')
{{ HTML::script('public/assets/js/images/view.js') }}
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
			@foreach($album->image as $index => $image)
            <article>
                <div class="detail_image_header">
                    <h2 class="detail_image_title">{{$image->title}}</h2>
                </div>
                <ul class="detail_image_info">
                    <li class="detail_image_info_date"><span >{{$image->updated_at}}</span></li>
                    <li class="detail_image_info_count_like"><span class="like"><i class="glyphicon glyphicon-heart"></i> <span>{{$image->count_like}}</span></span></li>
                    <li class="detail_image_info_count_share"><span><i class='glyphicon glyphicon-share'></i>{{$image->count_share}}</span></li>
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
            <!--Cái phần này c làm thành 1 cái slide ngang được thì tốt quá-->
            <!-- <p>Same album images</p> 
            <div class="same-album-images container-div">
                <ul>
                    @foreach($album->image as $index => $image)
                    @if($index != 0)
                    <li class="item-image">
                        <a href='{{Asset('image/view/'.$image->id)}}'>
                            <img class="img-rounded image-view" src="{{url('public/'.$image->path)}}" alt="{{$image->title}}">
                        </a>
                        <p>
                            <label>caption</label>
                            <span>{{$image->caption}}</span>
                        </p>
                    </li>
                    @endif
                    @endforeach
                </ul>
            </div> -->
		</div>
		<div class="image_right col-md-4">
			<ul>
				<li>
					<p>ĐĂNG BỞI</p>
					<a href="#" class="user_name">{{$album->user->name}}</a>
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