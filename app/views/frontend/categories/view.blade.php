@extends('frontend/layout/master')
@section('title')
	Chuyên mục {{ $data['category']->title }}
@stop
@section('content')
<h1>Chuyên mục {{ $data['category']->title }}</h1>
	<div class="container-div">
		<ul>
			@foreach($data['albums'] as $index => $album)
            @if ($album->image->count() > 0)
            <li class="item-image">
				<article>
                    <a href='{{Asset('album/view/'.$album->id)}}'><img src="{{url('public/'.$album->image->first()->path)}}" alt="{{$album->title}}"></a>
					<div class="photo_content">
                        <p class="sum-images">Số ảnh: {{$album->image->count()}}</p>
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