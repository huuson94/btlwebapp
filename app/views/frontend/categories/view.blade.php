@extends('frontend/layout/master')
@section('content')
<h1>Chuyên mục {{ $data['category']->title }}</h1>
	<div class="container-div">
		<ul>
			@foreach($data['albums'] as $index => $album)
            @if ($album->images->count() > 0)
            <li class="item-image">
				<article>
                    <a href='{{Asset('album/view/'.$album->id)}}'><img src="{{url('public/'.$album->images->first()->path)}}" alt="{{$album->title}}"></a>
					<div class="photo_content">
                        <p class="sum-images">Số ảnh: {{$album->images->count()}}</p>
						<p class="title">Title: {{$album->title}}</p>
						<p class="user_by">{{$album->user->name}}</p>
						<div class="view">
							<span class="like"><i class="glyphicon glyphicon-heart"></i> <span>{{$album->images->sum('count_like')}}</span></span>
							<span><i class='glyphicon glyphicon-share'></i>{{$album->images->sum('count_share')}}</span>
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
