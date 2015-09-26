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
	<div class="image_content">
		<div class="image_left col-md-8">
            <article>
                <div class="detail_image_header">
                    <h2 class="detail_image_title">{{$album->title}}</h2>
                </div>
                <ul class="detail_image_info">
                    <li class="detail_image_info_date"><span >{{$album->updated_at}}</span></li>
                    <li class="detail_image_info_count_like"><span class="like"><i>d</i> <span>{{$album->count_like}}</span></span></li>
                    <li class="detail_image_info_count_share"><span><i class='glyphicon glyphicon-share'></i>{{$album->count_share}}</span></li>
                </ul>
                <div class="photo_content">
                    <a href='{{Asset('image/view/'.$album->image->first()->id)}}'>
                        <img class="img-rounded image-view" src="{{url('public/'.$album->image->first()->path)}}" alt="{{$album->title}}">
                    </a>
                </div>
            </article>
            <!--Cái phần này c làm thành 1 cái slide ngang được thì tốt quá-->
            <p>Same album images</p> 
            <div class="same-album-images container-div">
                <ul>
                    @foreach($album->image as $index => $image)
                    @if($index != 0)
                    <li class="item-image">
                        <a href='{{Asset('image/view/'.$image->id)}}'>
                            <img class="img-rounded image-view" src="{{url('public/'.$image->path)}}" alt="{{$image->title}}">
                        </a>
                    </li>
                    @endif
                    @endforeach
                </ul>
            </div>
		</div>
		<div class="image_right col-md-4">
			<ul>
				<li>
					<p>ĐĂNG BỞI</p>
					<a href="#" class="user_name">{{$user_name}}</a>
				</li>
				<li>
					<p>GIỚI THIỆU</p>
					<p>{{ $album['description'] }}</p>
				</li>
				<li>
					<p>CHUYÊN MỤC</p>
					<p>{{ $album['category'] }}</p>
				</li>
				<li>
					<p>BÌNH LUẬN</p>
                    <textarea class="form-control" placeholder="Viết bình luận của bạn..."></textarea>
				</li>
			</ul>
		</div>
	</div>

@stop
