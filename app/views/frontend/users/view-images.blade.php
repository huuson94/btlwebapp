@extends('frontend/layout/master')
@section('title')
	Chia sẻ ảnh trực tuyến
@stop
@section('content')
	<div class="container-div">
		<ul>
			@foreach($data['albums'] as $index => $album)
            @if($album->images->count() > 0)
            <li class="item-image">
				<article>
					@if($album->images->count()>1)
                    <a href='{{Asset('album/view/'.$album->id)}}'>
                    @else
                    <a href='{{Asset('image/view/'.$album->images->first()->id)}}'>
                    @endif
                    	<img src="{{url('public/'.$album->images->first()->path)}}" alt="{{$album->title}}">
                    </a>
					<div class="photo_content">
						@if($album->images->count()>1)
                        <p class="sum-images">Album có: {{$album->images->count()}} ảnh</p>
                        @endif
						<p class="title">Title: {{$album->title}}</p>
						<p class="user_by">{{$album->user->name}}</p>
						<div class="view">
							<span class="like"><i class="glyphicon glyphicon-heart"></i> <span>{{$album->images->sum('count_like')}}</span></span>
							<span><i class='glyphicon glyphicon-share'></i>{{$album->images->sum('count_share')}}</span>
						</div>
					</div>
				</article>
			</li>
            @endif
            @endforeach
		</ul>
	</div>
@stop
