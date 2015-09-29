@extends('frontend/layout/master')
@section('style-bot')
{{ HTML::style('public/assets/css/albums/view.css') }}
@stop
@section('script-bot')
{{ HTML::script('public/assets/js/albums/view.js') }}
@stop
@section('title')
    Single Image Viewer
@stop
@section('content')
<div class='pull-left'>
    <img src='{{url('public/'.$image->path)}}'></img>
</div>
<div class='pull-right'>
    <p class="title">Title: {{$image->caption}}</p>
    <p class="user_by">{{$image->album->user->name}}</p>
    <div class="view">
        <span class="like"><i class="glyphicon glyphicon-heart"></i> <span>{{$image->count_like}}</span></span>
        <span><i class='glyphicon glyphicon-share'></i>{{$image->count_shares}}</span>
    </div>
    <!--<p><textarea $image->comment->content></textarea></p>-->
</div>
<div class='clearfix'></div>
@stop