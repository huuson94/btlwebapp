@extends('frontend/layout/master')
@section('width_70per')
	width_70per
@stop
@section('title')
	Photo Upload
@stop
@section('content')
	<div class="upload_content">
		<div class="upload_left">
			<h1>Đăng ảnh</h1>
			<p class="note">Sử dụng nút <span>Chọn ảnh</span> để chọn ảnh cho album của bạn. Đăng <span>tẹt ga thoải con gà mái nhé</span>!</p>
			<ul>
				<li>
					<p>Thể loại</p>
					<select>
						<option>Lựa chọn chuyên mục</option>
						<option>Phong cảnh</option>
						<option>Sexy</option>
						<option>Động vật</option>
						<option>Chó mèo</option>
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
		<div class="upload_right">
			
		</div>
	</div>
@stop