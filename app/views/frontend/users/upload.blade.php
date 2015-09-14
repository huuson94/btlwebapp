@extends('frontend/layout/master')
@section('width_70per')
	width_70per
@stop
@section('title')
	Photo Upload
@stop
@section('content')
  <script>
  
  </script>
	<div id='upload-image-tabs' class="upload_content">
          <ul>
            <li><a href="#upload-image-tabs">Đăng Ảnh</a></li>
            <li><a href="#upload-album-tabs">Đăng album</a></li>
            
          </ul>
		<div id='upload-image-tabs' class="upload_left">
			<h1>Đăng ảnh</h1>
			<p class="note">Sử dụng nút <span>Chọn ảnh</span> để chọn ảnh cho album của bạn. Đăng <span>tẹt ga thoải con gà mái nhé</span>!</p>
			<ul>
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
					<p>Tên Album</p>
					<input type="text" name="" placeholder="Tên Album">
				</li>
				<li>
					<p>Thông tin mô tả</p>
					<textarea placeholder="Thông tin mô tả"></textarea>
				</li>
			</ul>
		</div>
		<div id='upload-album-tabs' class="upload_right">
			
		</div>
	</div>
@stop