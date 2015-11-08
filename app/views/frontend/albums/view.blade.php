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
        <ul id="image-gallery" class="gallery list-unstyled cS-hidden">
        @foreach($album->images as $index => $image)
        <li data-thumb="{{url('public/'.$image->path)}}"> 
            <a href='{{url('image/view/'.$image->id)}}'><img class='preview' src="{{url('public/'.$image->path)}}" /></a>
        </li>
        @endforeach
        </ul>
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
