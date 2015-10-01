@extends('frontend/layout/master')
@section('script-bot')
	{{ HTML::script('public/assets/js/index.js') }}
@stop
@section('title')
	Chia sẻ ảnh trực tuyến
@stop
@section('content')
	<div class="container-div">
		<ul>
			@foreach($data['albums'] as $index => $album)
            @if ($album->image->count() > 0)
            @if ($album->image->count() == 1)
            <li class="item-image image">
            @elseif ($album->image->count() > 1)
            <li class="item-image album">
            @endif
            	<article>
					@if($album->image->count()>1)
                    <a href='{{Asset('album/view/'.$album->id)}}'>
                    @else
                    <a href='{{Asset('image/view/'.$album->image->first()->id)}}'>
                    @endif
                    	<img src="{{url('public/'.$album->image->first()->path)}}" alt="{{$album->title}}">
                    </a>
					<div class="photo_content">
						@if($album->image->count()>1)
                        <p class="sum-images">Album có: {{$album->image->count()}} ảnh</p>
                        @endif
						<p class="title">Title: {{$album->title}}</p>
						<p class="user_by">{{$album->user->name}}</p>
						<div class="view">
							<span class="like"><i class="glyphicon glyphicon-heart"></i> <span>{{$album->image->sum('count_like')}}</span></span>
							<span><i class='glyphicon glyphicon-share'></i>{{$album->image->sum('count_share')}}</span>
						</div>
					</div>
					{{-- {{ $data }} --}}
				</article>
			</li>
            @endif
            @endforeach
		</ul>
	</div>
@stop
