@extends('frontend/layout/master')
@section('title')
	Chia sẻ ảnh trực tuyến
@stop
@section('content')
	<div class="container-div">
		<ul>
			@foreach($data['albums'] as $index => $album)
            @if($album->is_single == 0)
            <li class="item-image album">
                @include('frontend/components/album', array('album' => $album))
                <div>
                    <a href="{{url('album/edit/'.$album->id)}}"><button class="btn btn-warning">Edit</button></a>
                </div>
            </li>
            @elseif($album->is_single == 1)
            <li class="item-image album">
                @include('frontend/components/image', array('image' => $album->images->first()))
                <div>
                    <a href="{{url('image/edit/'.$album->id)}}"><button class="btn btn-warning">Edit</button></a>
                </div>
            </li>
            @endif
            @endforeach
		</ul>
	</div>
@stop
