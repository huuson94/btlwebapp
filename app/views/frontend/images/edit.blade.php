@extends('frontend/layout/master')
@section('style-bot')
{{ HTML::style('public/assets/css/albums-images/show.css') }}
{{ HTML::style('public/assets/css/images/show.css') }}
@stop
@section('script-bot')
{{ HTML::script('public/assets/js/images/show.js') }}
{{ HTML::script('public/assets/js/albums-images/show.js') }}
<script type="text/javascript">
</script>
@stop
@section('title')
    Single Image Viewer
@stop
@section('content')
@if(Session::get('status') == 'success')
@foreach(Session::get('messages') as $message)
<p class="alert-success">
    {{$message}}
</p>
@endforeach

@elseif (Session::get('status') == 'false')
<p class="alert-danger">Failed</p>
@foreach(Session::get('messages') as $message)
<p class="alert-danger">
    {{$message}}
</p>
@endforeach
@endif
<div class="image_content row">
    
    {{ Form::open(array('url'=>'image/'.$image->id,'files'=>true, 'method' => 'PATCH', 'id' => 'upload-image-form')) }}
		<div class="image_left col-md-8">
            <article>
                <div class="detail_image_header">
                    <h2 class="detail_image_title">
                        Title<br/>
                        <input type='text' class='form-control' name='title' value='{{$image->album->title}}'>
                    </h2>
                </div>
                <ul class="detail_image_info">
                    <li class="detail_image_info_date"><span >{{$image->updated_at}}</span></li>
                    <li class="detail_image_info_count_like"><span class="like"><i class="glyphicon glyphicon-heart"></i> <span>{{$image->count_like}}</span></span></li>
                    <li class="detail_image_info_count_share"><span class="share"><i class='glyphicon glyphicon-share'></i> <span>{{$image->count_share}}</span></span></li>
                </ul>
                <div class="photo_content">
                    <a href='{{Asset('image/'.$image->id)}}'>
                        <img class="img-rounded image-view" src="{{url('public/'.$image->path)}}" alt="{{$image->album->title}}">
                    </a>
                    <p>
                        <label class="caption">Caption:</label>
                        <textarea class='form-control' name='caption'>{{$image->caption}}</textarea>
                    </p>
                </div>
            </article>
            <p>
                <input type='submit' class='btn btn-primary' value='Save'>
            </p>
            
		</div>
		<div class="image_right col-md-4">
			<ul>
				<li>
                    <p><b>Upload by</b></p>
					<p>
                       <a href="{{url('user/'.$image->album->user->id)}}" class="user_name">
                            <div>
                                <span>{{$image->album->user->name}}</span><img class='img-rounded avatar' src='{{url($image->album->user->avatar)}}'>
                            </div>
                        </a>
                    </p>
				</li>
<!--				<li>
                    <p><b>Description<b/></p>
					<p>
                        <textarea class='form-control'>{{ $image->album->description }}</textarea>
                    </p>
				</li>-->
				<li>
                    <p><b>Category</b></p>
					<p>
                        <select class='form-control' name='category_id'>
                            @foreach($categories as $category)
                            <option value='{{$category->id}}'
                                    @if($category->id == $image->album->category_id)
                                    selected='true'
                                    @endif
                                    >{{$category->title}}</option>
                            @endforeach
                        </select>
                    </p>
				</li>
			</ul>
            
            {{Form::close()}}
            @include('frontend/components/comment_box',array('post' => $image))
		</div>
        {{ Form::open(array('url'=>'image/'.$image->id,'files'=>true, 'method' => 'DELETE', 'id' => 'upload-image-form')) }}
        <div class="col-md-5">
            <input type="submit" class="btn btn-danger delete-image" value="Delete">
        </div>
        {{Form::close()}}
        <div class='clearfix'></div>
        
	</div>

@stop