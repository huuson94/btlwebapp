@extends('frontend/layout/master')
@section('script-bot')
	{{ HTML::script('public/assets/js/layout/master.js') }}
@stop
@section('title')
	Chia sẻ ảnh trực tuyến
@stop
@section('content')
	<div class="container-div">
		<ul>
			@foreach($albums as $index => $album)
                @if($album->public != 2)
                @if($album->is_single == 0)
                <li class="item-image album">
                    @include('frontend/components/album', array('album' => $album))
                </li>
                @elseif($album->is_single == 1)
                <li class="item-image image">
                    @include('frontend/components/image', array('image' => $album->images->first()))
                </li>
                @endif
                @endif
            @endforeach
		</ul>
	</div>
@stop
