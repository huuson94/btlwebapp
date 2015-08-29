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
@section('signin')
	<div class="pop-up-signin">
		<div class="wrapper">
			<form action="{{url('home/do-signin')}}" id="signin-form">
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
				
			//Effect for Signin
			$('.signin p').click(function(){
				$('.pop-up-signin').removeClass("slideOutLeft").addClass("animated slideInDown");
				$('.pop-up-signin').css("display","block");
			})
			$('.pop-up-signin span').click(function(){
				$('.pop-up-signin').addClass("slideOutLeft").removeClass("slideInDown");
				setTimeout(function(){
					$('.pop-up-signin').css("display","none");
				},600);
			})

			//Effect for Menu
			var stt=0;
			$('.categories p').click(function(){
				if(stt == 0){
					$('.menu').fadeIn();//addClass("animated fadeInDown");
					stt=1;
					$('.menu').css("display","block").removeClass("fadeOutLeft");
					$(this).addClass("clicked").find('span').addClass("clicked_span");
				}else{
					$('.menu').addClass("fadeOutLeft");
					stt=0;
					$('.menu').removeClass("fadeInDown");
					setTimeout(function(){
						$('.menu').css("display","none");
					},600);
					$(this).removeClass("clicked").find('span').removeClass("clicked_span");
				}
			})

			//NiceScroll
			$("html").niceScroll({ 
				zindex: 1000000, 
				cursorborderradius: "4px", // Làm cong các góc của scroll bar
				cursorcolor: "#EA6A48", // Màu của scroll bar
				cursorwidth:"10px", // Kích thước bề ngang của scroll bar
				autohidemode:false   //Tắt chế độ tự ẩn của scroll bar
				});

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

/*****************************SIGNIN FORM**************************/
		$('#signin-form').submit(function(e) {
			e.preventDefault();
			$('.error').html('');
			$('#signin-form div p').remove();
			$.ajax({
				url: $(this).attr('action'),
				data: new FormData($('#signin-form')[0]),
				type: 'POST',
				contentType: false,
				processData: false,
				cache: false,
			}).done(function(data){
				if(data=='success'){
					$('.signin .error').append('<p>* Đăng ký thành công! Chuyển về trang chủ để đăng nhập</p>');
					window.location.reload();
				}else if(data=='fail'){
					$('.signin input[name="account"]').after('<p>* Tài khoản đã tồn tại</p>');
				}else{
					var msg=$.parseJSON(data);
					$.each(msg,function(key,val){
						if( key=='name' )$('.signin input[name="name"]').after('<p>*'+val+'</p>');
						if( key=='account' )$('.signin input[name="account"]').after('<p>*'+val+'</p>');
						if( key=='password' )$('.signin input[name="password"]').after('<p>*'+val+'</p>');
						if( key=='email' )$('.signin input[name="email"]').after('<p>*'+val+'</p>');
						if( key=='phone' )$('.signin input[name="phone"]').after('<p>*'+val+'</p>');
						if( key=='address' )$('.signin input[name="address"]').after('<p>*'+val+'</p>');
					})
				}
			}).fail(function(){
				alert('Lỗi #TK01');
			})
		})
</script>
@stop