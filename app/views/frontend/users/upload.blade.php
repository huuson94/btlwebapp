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
    
	<div id='upload-image-tabs' class="upload_content col-md-10 center-block">
          <ul>
            <li><a href="#upload-image-tabs">Đăng Ảnh</a></li>
            <li><a href="#upload-album-tabs">Đăng album</a></li>
          </ul>
        <div class='upload-image-form-template'>
            <ul>
                <li>
                    <p>Chọn ảnh</p>
                    <p>{{Form::file('path[]', array("accept" => "image/*", "class" => "single form-control"))}}</p>
                    <p><img class='img-rounded img-thumbnail'></p>
                </li>
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
            <p>
                <input type="button" class="delete-image btn btn-danger" value="Delete image">
            </p>
        </div>
		<div id='upload-image-tabs' class="upload_left">
            
                {{ Form::open(array('url'=>'image/save','files'=>true, 'method' => 'POST')) }}
                <h1>Đăng ảnh</h1>
                <p class="note">Sử dụng nút <span>Chọn ảnh</span> để chọn ảnh cho album của bạn. Đăng <span>tẹt ga thoải con gà mái nhé</span>!</p>
                <p>
                    <input type="button" class="add-image btn btn-default" value="Add image">
                </p>
                <div class='upload-image-form'>
                    <ul>
                        <li>
                            <p>Chọn ảnh</p>
                            <p>{{Form::file('path[]', array("accept" => "image/*", "class" => "single form-control"))}}</p>
                            <p><img class='img-rounded img-thumbnail'></p>
                        </li>
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
                    <p>
                        <input type="button" class="delete-image btn btn-danger" value="Delete image">
                    </p>
                </div>
                
                <p><input type="submit" class="btn btn-default form-control" value="Upload"></p>
            {{Form::close()}}
        </div>
		<!--Can kiem tra xem khi nguoi chuyen tab nguoi dung da submit chua-->
		<div id='upload-album-tabs' class="upload_right">
            <form action="{{url('album/save')}}" method="POST">
                <h1>Tạo album</h1>
                <p class="note">Sử dụng nút <span>Chọn ảnh</span> để chọn ảnh cho album của bạn. Đăng <span>tẹt ga thoải con gà mái nhé</span>!</p>
                <div>
                    <ul>
                        <li>
                            <p>Chọn ảnh</p>
                            <p>{{Form::file('path[]', array("accept" => "image/*", "class" => "single form-control", 'multiple' => 'true'))}}</p>
                            <p><img class='img-rounded img-thumbnail'></p>
                        </li>
                        <li>
                            <p>Thể loại</p>
                            <select>
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
                            <textarea class="form-control" placeholder="Thông tin mô tả"></textarea>
                        </li>
                    </ul>
                </div>
                <p><input type="submit" class="btn btn-default form-control" value="Upload"></p>
            </form>
        </div>
	</div>
    <div class="clearfix"></div>
@stop