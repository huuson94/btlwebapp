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
					<a href="">HOME</a>
				</li>
				<li>
					<input type="text" placeholder="Tìm kiếm ..." class="search">
					<button class="icon-search">\</button>
				</li>
			</ul>
			<ul class="login_singin_area">
				@if(Session::has('my_user'))
					<li class="login">
						<a><p>XIN CHÀO <span class="user_name">{{ Session::get('my_user')['name'] }}</span></p></a>
					</li>
					<li><a href="{{url('home/logout')}}">ĐĂNG XUẤT</a></li>
				@else
					<li class="login">
						<a><p>ĐĂNG NHẬP</p></a>
						@yield('login')
					</li>
					<li class="signin">
						<a><p>ĐĂNG KÝ</p></a>
						@yield('signin')
					</li>
				@endif
			</ul>
		</div>
	</header>
	<section>
		<div class="wrapper">
			<div class="categories">
				<p><span></span>Danh mục</p>
				<div class="menu">
					<ul>
						<li><a href="">Ảnh hot nhất</a></li>
						<li><a href="">Người đẹp</a></li>
					</ul>
					<ul>
						<li><a href="">Mới nhất</a></li>
						<li><a href="">Phong cảnh</a></li>
						<li><a href="">Mùa cưới</a></li>
						<li><a href="">Hài hước-giải trí</a></li>
						<li><a href="">Thể loại khác</a></li>
						<li><a href="">Con người & Cuộc sống</a></li>
					</ul>
					<ul class="team_contact">
						<li><a href="">Giới thiệu</a></li>
						<li><a href="">Chính Sách Riêng Tư</a></li>
						<li><a href="">Hỗ Trợ</a></li>
						<li><a href="">Liên Hệ</a></li>
					</ul>
				</div>
			</div>
			<p class="category">Phong cảnh</p>
			<div class="container">
				<ul>
					<li class="item">
						<article>
							<img src="{{url('public/upload/images/Chrisfr06_Blue galaxy_ak1nRw.jpg')}}" alt="">
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
		</div>
	</section>
	@yield('script-bot')
</body>
</html>