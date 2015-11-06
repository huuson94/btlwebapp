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
                @include('frontend/components/comment_box',array('post' => $album))
			</ul>
		</div>
	</div>

@stop
