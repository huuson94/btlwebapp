<!DOCTYPE html>
<html>
<head>
	<title>@yield('title')</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="{{url('public/assets/css/style.css')}}">
	<link rel="stylesheet" href="{{url('public/assets/css/animate.css')}}">
	<link rel="shortcut icon" href="{{url('public/favicon.ico')}}">
	<script type="text/javascript" src="{{url('public/assets/js/jquery-1.11.3.min.js')}}"></script>
	<script type="text/javascript" src="{{url('public/assets/js/masonry.pkgd.min.js')}}"></script>
	<script src="{{url('public/assets/js/jquery.nicescroll.js')}}" type='text/javascript'></script>
</head>
<body>
	<header>
		<div class="top">
			<h1>Photo</h1>
			<ul class="search_area">
				<li>
					<div class="logo">
						<img src="{{url('public/assets/images/logo.png')}}" alt="logo">
					</div>
				</li>
				<li>
					<a href="{{url('/home')}}">HOME</a>
				</li>
				<li>
					<input type="text" placeholder="Tìm kiếm ..." class="search">
					<button class="icon-search">\</button>
				</li>
			</ul>
			<ul class="login_singin_area">
				@if(Session::has('current_user'))
					<li class="login">
						<a href=""><p>XIN CHÀO <span class="user_name">{{ Session::get('current_user')['name'] }}</span></p></a>
					</li>
					<li><a href="{{url('home/logout')}}">ĐĂNG XUẤT</a></li>
				@else
					<li class="login">
						<a><p>ĐĂNG NHẬP</p></a>
						@yield('login')
					</li>
					<li class="signup">
						<a><p>ĐĂNG KÝ</p></a>
						@yield('signup')
					</li>
				@endif
			</ul>
		</div>
	</header>
	<section>
		<div class="wrapper @yield('width_70per')">
			@yield('category')
			<div class="categories @yield('width_70per')">
				<p class="menu_button"><span></span>Danh mục</p>
				<div class="menu">
					<ul>
						<li><a href="">Ảnh hot nhất</a></li>
						<li><a href="">Mới Nhất</a></li>
					</ul>
					<ul>
						@foreach($categories as $index => $category)
                        <li><a href="{{Asset('category/view/'.$category->id)}}">{{$category->title}}</a></li>
                        @endforeach
					</ul>
					<ul class="team_contact">
						<li><a href="">Giới thiệu</a></li>
						<li><a href="">Chính Sách Riêng Tư</a></li>
						<li><a href="">Hỗ Trợ</a></li>
						<li><a href="">Liên Hệ</a></li>
					</ul>
				</div>
				@if(Session::has('current_user'))
					<a href="{{url('/user/upload')}}"><p class="upload_button"><i>â</i>Đăng ảnh</p></a>
					<a href="{{url('/user/view-image')}}"><p class="mypic_button">Ảnh của tôi</p></a>
				@endif
			</div>
			@yield('content')
		</div>
	</section>
	@yield('script-bot')
	<script type="text/javascript">
		$(document).ready(function(){
			//Effect for Menu
			var stt=0;
			$('.categories .menu_button').click(function(){
				if(stt == 0){
					$('.menu').fadeIn();//addClass("animated fadeInDown");
					stt=1;
					//$('.menu').css("display","block").removeClass("fadeOutLeft");
					$(this).addClass("clicked").find('span').addClass("clicked_span");
				}else{
					$('.menu').fadeOut();//addClass("fadeOutLeft");
					stt=0;
					// $('.menu').removeClass("fadeInDown");
					// setTimeout(function(){
					// 	$('.menu').css("display","none");
					// },600);
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

			$(window).scroll(function(){
				var x=$(window).scrollTop();
				if(x>40){
					if($('.categories').is(':visible'))
						$('.categories').fadeOut(300);
				}else{
					if(!$('.categories').is(':visible'))
						$('.categories').fadeIn(300);
				}
			});
		})
	</script>
</body>
</html>