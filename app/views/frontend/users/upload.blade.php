@extends('frontend/layout/master')
@section('style-bot')
{{ HTML::style('public/assets/css/users/upload.css') }}
@stop
@section('script-bot')
{{ HTML::script('public/assets/js/users/upload.js') }}
@stop
@section('width_70per')
	width_70per
@stop
@section('title')
	Photo Upload
@stop
@section('content')
    
    @if(Session::get('status') == 'success')
    <p class="alert-success">Saved</p>
    @elseif (Session::get('status') == 'fail')
    <p class="alert-danger">Can't save</p>
    @endif
    <div id='upload-tabs' class="upload_content col-md-10 center-block">
          <ul>
            <li><a href="#upload-image-tabs">Upload Images</a></li>
            <li><a href="#upload-album-tabs">Upload Album</a></li>
          </ul>
        <div class='upload-image-form-template'>
            <ul>
                <li>
                    <p>Thể loại</p>
                    <select name="category[]">
                        @foreach($categories as $index => $category)
                        <option value="{{$category->id}}">{{$category->title}}</option>
                        @endforeach
                    </select>
                </li>
                <li>
                    <p>Tiêu đề</p>
                    <input class="form-control" placeholder="Tiêu đề" name="title[]">
                </li>
                <li>
                    <p>Thông tin mô tả</p>
                    <textarea class="form-control" placeholder="Thông tin mô tả" name="description[]"></textarea>
                </li>
            </ul>
            
        </div>
		<div id='upload-image-tabs' class="upload_left">
            
                {{ Form::open(array('url'=>'image/save','files'=>true, 'method' => 'POST')) }}
                <div id="images-description" style="display: none"></div>
                <h1>Đăng ảnh</h1>
                <p class="note">Sử dụng nút <span>Add image</span> để chọn ảnh của bạn. Đăng <span>tẹt ga thoải con gà mái nhé</span>!</p>
                <div class='upload-image-form'>
                    <ul>
                        <li>
                            <p class="control-label">Chọn ảnh</p>
                            <p>{{Form::file('path[]', array("accept" => "image/*", "class" => "single form-control", 'multiple' => 'true'))}}</p>
                            <!--<p><img class='img-rounded img-thumbnail'></p>-->
                        </li>
                        
                    </ul>
                    
                </div>
                
                <p><input type="submit" class="btn btn-default" value="Upload"></p>
            {{Form::close()}}
        </div>
		<div id='upload-album-tabs' class="upload_right">
            {{ Form::open(array('url'=>'album/save','files'=>true, 'method' => 'POST')) }}
                <h1>Tạo album</h1>
                <p class="note">Sử dụng nút <span>Chọn ảnh</span> để chọn ảnh cho album của bạn. Đăng <span>tẹt ga thoải con gà mái nhé</span>!</p>
                <div>
                    <ul>
                        <li>
                            <p>Chọn ảnh</p>
                            <p>{{Form::file('path[]', array("accept" => "image/*", "class" => "multiple form-control", 'multiple' => 'true'))}}</p>
                            <div class='album-preview'></div>
                        </li>
                        <li>
                            <p>Thể loại</p>
                            <select name="category">
                                @foreach($categories as $index => $category)
                                <option value="{{$category->id}}">{{$category->title}}</option>
                                @endforeach
                            </select>
                        </li>
                        <li>
                            <p>Tiêu đề</p>
                            <input class="form-control" placeholder="Tiêu đề" name="title">
                        </li>
                        <li>
                            <p>Thông tin mô tả</p>
                            <textarea class="form-control" placeholder="Thông tin mô tả" name='description'></textarea>
                        </li>
                    </ul>
                </div>
                <p><input type="submit" class="btn btn-default" value="Upload"></p>
            {{Form::close()}}
        </div>
	</div>
    <div class="clearfix"></div>
@stop