@extends('frontend/layout/master')
@section('title')
	Chia sẻ ảnh trực tuyến
@stop
@section('login')
	<div class="pop-up">
		<div class="wrapper">
			<form action="{{url('home/do-login')}}" id="login-form">
				<input type="text" name="account" placeholder="Nhập tài khoản">
				<input type="password" name="password" placeholder="Nhập mật khẩu">
				<button>Đăng nhập</button>
			</form>
			<p class="error"></p>
			<span title="Click to close">x</span>
		</div>
	</div>
@stop
@section('signup')
	<div class="pop-up-signup">
		<div class="wrapper">
			<form action="{{url('home/do-signup')}}" id="signup-form">
				<div><input type="text" name="name" placeholder="Họ và tên"></div>
				<div><input type="text" name="account" placeholder="Nhập tài khoản"></div>
				<div><input type="password" name="password" placeholder="Nhập mật khẩu"></div>
				<div><input type="text" name="email" placeholder="Email( example@gmail.com )"></div>
				<div><input type="text" name="phone" placeholder="Nhập số điện thoại"></div>
				<div><input type="text" name="address" placeholder="Nhập địa chỉ"></div>
				<button>Đăng Ký</button>
			</form>
			<p class="error"></p>
			<span title="Click to close">x</span>
		</div>
	</div>
@stop
@section('category')
	<span class="category">Phong cảnh</span>
@stop
@section('content')
	<div class="container">
		<ul>
			<li class="item">
				<article>
					<img src="{{url('public/upload/images/Chrisfr06_Blue galaxy_ak1nRw.jpg')}}" alt="">
					<div class="photo_content">
						<a href="/home/detail/1"><p class="title">Vietnamese Girl Washing Car</p></a>
						<p class="user_by">Bao Huy Bao Huy</p>
						<div class="view">
							<span class="like"><i>d</i> <span>16</span></span>
							<span><i>„</i> 8000</span>
						</div>
					</div>
				</article>
			</li>
			<li class="item">
				<article>
					<img src="{{url('public/upload/images/Fe Ilya_Voices_Z0RhQg.jpg')}}" alt="">
					<div class="photo_content">
						<p class="title">Vietnamese Girl Washing Car</p>
						<p class="user_by">Bao Huy Bao Huy</p>
						<div class="view">
							<span class="like"><i>d</i> <span>16</span></span>
							<span><i>„</i> 8000</span>
						</div>
					</div>
				</article>
			</li>
			<li class="item">
				<article>
					<img src="{{url('public/upload/images/photosteve101_Music Is My Life_YkxhQw.jpg')}}" alt="">
					<div class="photo_content">
						<p class="title">Vietnamese Girl Washing Car</p>
						<p class="user_by">Bao Huy Bao Huy</p>
						<div class="view">
							<span class="like"><i>d</i> <span>16</span></span>
							<span><i>„</i> 8000</span>
						</div>
					</div>
				</article>
			</li>
			<li class="item">
				<article>
					<img src="{{url('public/upload/images/photosteve101_Music Is My Life_YkxhQw.jpg')}}" alt="">
					<div class="photo_content">
						<p class="title">Vietnamese Girl Washing Car</p>
						<p class="user_by">Bao Huy Bao Huy</p>
						<div class="view">
							<span class="like"><i>d</i> <span>16</span></span>
							<span><i>„</i> 8000</span>
						</div>
					</div>
				</article>
			</li>
			<li class="item">
				<article>
					<img src="{{url('public/upload/images/Fe Ilya_Voices_Z0RhQg.jpg')}}" alt="">
					<div class="photo_content">
						<p class="title">Vietnamese Girl Washing Car</p>
						<p class="user_by">Bao Huy Bao Huy</p>
						<div class="view">
							<span class="like"><i>d</i> <span>16</span></span>
							<span><i>„</i> 8000</span>
						</div>
					</div>
				</article>
			</li>
		</ul>
	</div>
@stop
@section('script-bot')
	<script>
		$(document).ready(function() {
			var $container = $('.container');
				$container.masonry({
					itemSelector: '.item',
					columWidth:200
			});

			//count like
			$('.like').click(function(){
				var x=$(this).find('span').text();
				if($(this).find('i').text()=='d'){$(this).find('i').text('c');x++;$(this).find('span').text(x);}
					else {$(this).find('i').text('d');x--;$(this).find('span').text(x);}
			})

			//Effect for Login
			$('.login p').click(function(){
				$('.pop-up').removeClass("zoomOut").addClass("animated bounceInLeft");
				$('.pop-up').css("display","block");
			})
			$('.pop-up span').click(function(){
				$('.pop-up').addClass("zoomOut").removeClass("bounceInLeft");
				setTimeout(function(){
					$('.pop-up').css("display","none");
				},600);
			})
				
			//Effect for Signup
			$('.signup p').click(function(){
				$('.pop-up-signup').removeClass("slideOutLeft").addClass("animated slideInDown");
				$('.pop-up-signup').css("display","block");
			})
			$('.pop-up-signup span').click(function(){
				$('.pop-up-signup').addClass("slideOutLeft").removeClass("slideInDown");
				setTimeout(function(){
					$('.pop-up-signup').css("display","none");
				},600);
			})
			
		})
		
/*****************************LOGIN FORM**************************/
		$('#login-form').submit(function(e) {
			e.preventDefault();
			$('.error').html('');
			$.ajax({
				url: $(this).attr('action'),
				data: new FormData($('#login-form')[0]),
				type: 'POST',
				contentType: false,
				processData: false,
				cache: false,
			}).done(function(data){
				if(data=='success'){
					$('.login .error').append('<p>* Đăng nhập thành công</p>');
					window.location.reload();
				}else{
					$('.login .error').append('<p>* Sai tài khoản hoặc mật khẩu</p>');
				}
			}).fail(function(){
				alert('Lỗi #TK01');
			})
		})

/*****************************SINGUP FORM**************************/
		$('#signup-form').submit(function(e) {
			e.preventDefault();
			$('.error').html('');
			$('#signup-form div p').remove();
			$.ajax({
				url: $(this).attr('action'),
				data: new FormData($('#signup-form')[0]),
				type: 'POST',
				contentType: false,
				processData: false,
				cache: false,
			}).done(function(data){
				if(data=='success'){
					$('.signup .error').append('<p>* Đăng ký thành công! Chuyển về trang chủ để đăng nhập</p>');
					window.location.reload();
				}else if(data=='fail'){
					$('.signup input[name="account"]').after('<p>* Tài khoản đã tồn tại</p>');
				}else{
					var msg=$.parseJSON(data);
					$.each(msg,function(key,val){
						if( key=='name' )$('.signup input[name="name"]').after('<p>*'+val+'</p>');
						if( key=='account' )$('.signup input[name="account"]').after('<p>*'+val+'</p>');
						if( key=='password' )$('.signup input[name="password"]').after('<p>*'+val+'</p>');
						if( key=='email' )$('.signup input[name="email"]').after('<p>*'+val+'</p>');
						if( key=='phone' )$('.signup input[name="phone"]').after('<p>*'+val+'</p>');
						if( key=='address' )$('.signup input[name="address"]').after('<p>*'+val+'</p>');
					})
				}
			}).fail(function(){
				alert('Lỗi #TK01');
			})
		})
</script>
@stop