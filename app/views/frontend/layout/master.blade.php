<!DOCTYPE html>
<html>
<head>
	<title>@yield('title')</title>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="{{url('public/favicon.ico')}}">
	
    {{ HTML::style('public/assets/css/style.css') }}
    {{ HTML::style('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css') }}
    {{ HTML::style('public/assets/css/jquery-ui.min.css') }}
    {{ HTML::style('public/assets/css/animate.css') }}
    @yield('style-bot')
    {{ HTML::script('public/assets/js/jquery-1.11.3.min.js') }}
    {{ HTML::script('public/assets/js/jquery-ui.min.js') }}
    {{ HTML::script('public/assets/js/jquery.nicescroll.js') }}
    {{ HTML::script('public/assets/js/scripts.js') }}
    {{ HTML::script('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js') }}
    {{ HTML::script('public/assets/js/masonry.pkgd.min.js') }}
    @yield('script-bot')
    {{ HTML::style("vendor/kartik-v/bootstrap-fileinput/css/fileinput.min.css")}}
    {{ HTML::script("vendor/kartik-v/bootstrap-fileinput/js/plugins/canvas-to-blob.min.js")}}
    {{ HTML::script("vendor/kartik-v/bootstrap-fileinput/js/fileinput.min.js")}}
    {{ HTML::script("vendor/kartik-v/bootstrap-fileinput/js/fileinput_locale_<lang>.js")}}
    
    
</head>
<body>
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
//				if(x>40){
//					if($('.categories').is(':visible'))
//						$('.categories').fadeOut(300);
//				}else{
//					if(!$('.categories').is(':visible'))
//						$('.categories').fadeIn(300);
//				}
			});
		})
	</script>
    <header class='col-md-12'>
		<div class="top">
			<div class="col-md-3 logo">
                <h1  style='display: none;'>Photo</h1>
                <h4 class='col-md-8'><a href="{{url('/home')}}"><img src="{{url('public/assets/images/logo.png')}}" alt="logo"/></a></h4>
                <h4 id='link-to-home' class='col-md-4'><a href="{{url('/home')}}">HOME</a><h4>
            </div>
			<ul class="col-md-6 search_area">
				
				<li>
                    <form action="{{url('home/search')}}" method="get">
                        <p class='col-md-10'><input type="text" placeholder="Tìm kiếm ..." class="search form-control" name="title" style="display: inline"><p>
                        <input type="submit" class="col-md-2 btn btn-default" value="Search">
                        <!--<button class="icon-search">\</button>-->
                    </form>
				</li>
			</ul>
			<ul class="col-md-3 login_singin_area">
				@if(Session::has('current_user'))
					<li class="col-md-7 login">
						<a href=""><p>XIN CHÀO <span class="user_name">{{ $user_name }}</span></p></a>
					</li>
					<li class='col-md-5'><a href="{{url('user/logout')}}">ĐĂNG XUẤT</a></li>
				@else
					<li class="col-md-7 login">
						<a><p class="btn btn-default">ĐĂNG NHẬP</p></a>
						@yield('login')
					</li>
					<li class="col-md-5 signup" >
						<a><p class="btn btn-default">ĐĂNG KÝ</p></a>
						@yield('signup')
					</li>
				@endif
			</ul>
		</div>
	</header>
    <div class="clearfix"></div>
    <nav>
        <div class="categories col-md-8">
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
            </div>
        </div>
        @if(Session::has('current_user'))
        <div class='images-manage-buttons col-md-4 '>
            <p class="col-md-6 pull-right"><a  class="btn btn-primary upload_button" href="{{url('/user/upload')}}">Đăng ảnh</a></p>
            <p class="col-md-3 pull-right"><a class="btn btn-primary mypic_button" href="{{url('/user/view-images')}}">Ảnh của tôi</a></p>
        </div>
        @endif
    </nav>
    <section>
        <div class="wrapper">
            @yield('content')
        </div>
        <aside>

        </aside>
    </section>
    
    <footer>
        <ul class="team_contact">
            <li><a href="">Giới thiệu</a></li>
            <li><a href="">Chính Sách Riêng Tư</a></li>
            <li><a href="">Hỗ Trợ</a></li>
            <li><a href="">Liên Hệ</a></li>
        </ul>
    </footer>
</body>
</html>