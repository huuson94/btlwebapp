@extends('frontend/layout/master')
@section('width_70per')
	width_70per
@stop
@section('title')
	Photo Upload
@stop
@section('content')
@section('script-bot')
<script>
  $(document).ready(function(){
     $( "#upload-image-tabs" ).tabs();
     $(".add-image-regist").click(function(){
        var thumb = $(this);
        thumb.before("<div class='upload-image-form'>"+$("div.upload-image-form").html()+"</div>");
        
     });
  });
</script>
@stop
  
	<div id='upload-image-tabs' class="upload_content">
          <ul>
            <li><a href="#upload-image-tabs">Đăng Ảnh</a></li>
            <li><a href="#upload-album-tabs">Đăng album</a></li>
            
          </ul>
		<div id='upload-image-tabs' class="upload_left">
            <form action="{{url('image/save')}}" method="POST">
                <h1>Đăng ảnh</h1>
                <p class="note">Sử dụng nút <span>Chọn ảnh</span> để chọn ảnh cho album của bạn. Đăng <span>tẹt ga thoải con gà mái nhé</span>!</p>
                <div class='upload-image-form'>
                    <ul>
                        <li>
                            <p>Chọn ảnh</p>
                            <input type="file" class="form-control" name="img"  accept="image/*">
                        </li>
                        <li>
                            <p>Thể loại</p>
                            <select>
                                <option></option>
                                @foreach($categories as $index => $category)
                                <option>{{$category->title}}</option>
                                @endforeach
                            </select>
                        </li>
                        <li>
                            <p>Thông tin mô tả</p>
                            <textarea placeholder="Thông tin mô tả"></textarea>
                        </li>
                    </ul>
                </div>
                <p><input type="button" class="add-image-regist btn btn-default" value="Add image"></p>
                <p><input type="submit" class="btn btn-default form-control" value="Upload"></p>
            </form>
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
                            <input type="file" class="form-control" name="img"  accept="image/*">
                        </li>
                        <li>
                            <p>Thể loại</p>
                            <select>
                                <option></option>
                                @foreach($categories as $index => $category)
                                <option>{{$category->title}}</option>
                                @endforeach
                            </select>
                        </li>
                        <li>
                            <p>Thông tin mô tả</p>
                            <textarea placeholder="Thông tin mô tả"></textarea>
                        </li>
                    </ul>
                </div>
                <p><input type="button" class="add-image-regist btn btn-default" value="Add image"></p>
                <p><input type="submit" class="btn btn-default form-control" value="Upload"></p>
            </form>
        </div>
	</div>
@stop