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
                @if($album->is_single == 0)
                    @include('frontend/components/album', array('album' => $album))
                @elseif($album->is_single == 1)
                    @include('frontend/components/image', array('image' => $album->images->first()))
                @endif
            @endforeach
		</ul>
	</div>
@stop
