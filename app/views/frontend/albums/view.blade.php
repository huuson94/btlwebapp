@extends('frontend/layout/master')
@section('style-bot')
{{ HTML::style('public/assets/css/albums-images/view.css') }}
{{ HTML::style('public/assets/css/albums/view.css') }}
{{ HTML::style('public/assets/css/albums/slider.css') }}
@stop
@section('script-bot')
{{ HTML::script('public/assets/js/albums/jquery-ui-1.10.3.custom.min.js') }}
{{ HTML::script('public/assets/js/albums/jquery.kinetic.min.js') }}
{{ HTML::script('public/assets/js/albums/jquery.mousewheel.min.js') }}
{{ HTML::script('public/assets/js/albums/jquery.smoothdivscroll-1.3-min.js') }}
{{ HTML::script('public/assets/js/albums-images/view.js') }}
{{ HTML::script('public/assets/js/albums/view.js') }}
{{ HTML::script('public/assets/js/albums/slider.js') }}
@stop
@section('width_70per')
	width_70per
@stop
@section('title')
	Image Viewer
@stop
@section('content')
<style>
.jssora05l, .jssora05r{
    background:  no-repeat;
}
</style>
<div id="jssor_1" style="position: relative; margin: 0 auto; top: 0px; left: 0px; width: 800px; height: 456px; overflow: hidden; visibility: hidden; background-color: #24262e;">
    <!-- Loading Screen -->
    <div data-u="loading" style="position: absolute; top: 0px; left: 0px;">
        <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
        <div style="position:absolute;display:block;background:url('img/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
    </div>
    <div data-u="slides" style="cursor: default; position: relative; top: 0px; left: 0px; width: 800px; height: 356px; overflow: hidden;">
        @foreach($album->images as $image)
        <div data-p="144.50" style="display: none;">
            <img data-u="image" src="{{url('public/'.$image->path)}}" />
            <img data-u="thumb" src="{{url('public/'.$image->path)}}" />
        </div>
        @endforeach
    </div>
    <!-- Thumbnail Navigator -->
    <div data-u="thumbnavigator" class="jssort01" style="position:absolute;left:0px;bottom:0px;width:800px;height:100px;" data-autocenter="1">
        <!-- Thumbnail Item Skin Begin -->
        <div data-u="slides" style="cursor: default;">
            <div data-u="prototype" class="p">
                <div class="w">
                    <div data-u="thumbnailtemplate" class="t"></div>
                </div>
                <div class="c"></div>
            </div>
        </div>
        <!-- Thumbnail Item Skin End -->
    </div>
    <!-- Arrow Navigator -->
    <span data-u="arrowleft" class="jssora05l" style="top:158px;left:8px;width:40px;height:40px; "></span>
    <span data-u="arrowright" class="jssora05r" style="top:158px;right:8px;width:40px;height:40px;"></span>
</div>
@stop
