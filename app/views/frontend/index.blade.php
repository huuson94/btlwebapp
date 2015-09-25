@extends('frontend/layout/master')
@section('script-bot')
	<script>
		$(document).ready(function() {
			var $container = $('.container-div');
            $container.masonry({
                itemSelector: '.item-image',
                columWidth:200
            });
           
//			//count like
//			$('.like').click(function(){
//				var x=$(this).find('span').text();
//				if($(this).find('i').text()=='d'){$(this).find('i').text('c');x++;$(this).find('span').text(x);}
//					else {$(this).find('i').text('d');x--;$(this).find('span').text(x);}
//			});
//            
			//Effect for Login
			$('.login p').click(function(){
				$('.pop-up').removeClass("zoomOut").addClass("animated bounceInLeft");
				$('.pop-up').css("display","block");
			});
			$('.pop-up span').click(function(){
				$('.pop-up').addClass("zoomOut").removeClass("bounceInLeft");
				setTimeout(function(){
					$('.pop-up').css("display","none");
				},600);
			});
//				
//			//Effect for Signup
			$('.signup p').click(function(){
				$('.pop-up-signup').removeClass("slideOutLeft").addClass("animated slideInDown");
				$('.pop-up-signup').css("display","block");
			});
			$('.pop-up-signup span').click(function(){
				$('.pop-up-signup').addClass("slideOutLeft").removeClass("slideInDown");
				setTimeout(function(){
					$('.pop-up-signup').css("display","none");
				},600);
			});
			
		
		
/*****************************LOGIN FORM**************************/
        $('#login-form').submit(function(e) {
            e.preventDefault();
            var obj = $(this);
			obj.next().html('');
			$.ajax({
				url: $(this).attr('action'),
				data: new FormData($('#login-form')[0]),
				type: 'POST',
				contentType: false,
				processData: false,
				cache: false,
			}).done(function(data){
				if(data=='success'){
					obj.next().html('<p>* Đăng nhập thành công</p>');
					window.location.reload();
				}else{
					obj.next().html('<p>* Sai tài khoản hoặc mật khẩu</p>');
				}
			}).fail(function(){
				alert('* Sai tài khoản hoặc mật khẩu');
			});
		});

///*****************************SINGUP FORM**************************/
		$('#signup-form').submit(function(e) {
            
			e.preventDefault();
            var obj = $(this);
            
			obj.next().html('');
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
					obj.next().html('<p>* Đăng ký thành công! Chuyển về trang chủ để đăng nhập</p>');
					window.location.reload();
				}else if(data=='fail'){
					obj.next().html('<p>* Tài khoản đã tồn tại</p>');
				}else{
                    obj.next().html('<p>* Thông tin không hợp lệ.</p>');
					var msg=$.parseJSON(data);
					$.each(msg,function(key,val){
						if( key=='name' )$('.signup input[name="name"]').after('<p>*'+val+'</p>');
						if( key=='account' )$('.signup input[name="account"]').after('<p>*'+val+'</p>');
						if( key=='password' )$('.signup input[name="password"]').after('<p>*'+val+'</p>');
						if( key=='email' )$('.signup input[name="email"]').after('<p>*'+val+'</p>');
						if( key=='phone' )$('.signup input[name="phone"]').after('<p>*'+val+'</p>');
						if( key=='address' )$('.signup input[name="address"]').after('<p>*'+val+'</p>');
					});
				}
			}).fail(function(){
				alert('* Tài khoản đã tồn tại');
			});
		});
//        
});
        
</script>
@stop
@section('title')
	Chia sẻ ảnh trực tuyến
@stop
@section('login')
	<div class="pop-up">
		<div class="wrapper">
            <form action="{{url('user/ajax-login')}}" id="login-form" method="POST">
				<input type="text" name="account" placeholder="Nhập tài khoản">
				<input type="password" name="password" placeholder="Nhập mật khẩu">
                <button class="submit">Đăng nhập</button>
			</form>
			<p class="error" style="text-align: center"></p>
			<span title="Click to close">x</span>
		</div>
	</div>
@stop
@section('signup')
	<div class="pop-up-signup">
		<div class="wrapper">
			<form action="{{url('user/ajax-signup')}}" id="signup-form" method="POST">
				<div><input type="text" name="name" placeholder="Họ và tên"></div>
				<div><input type="text" name="account" placeholder="Nhập tài khoản"></div>
				<div><input type="password" name="password" placeholder="Nhập mật khẩu"></div>
                <div><input type="password" name="password_confirm" placeholder="Nhập lại mật khẩu"></div>
				<div><input type="text" name="email" placeholder="Email( example@gmail.com )"></div>
				<div><input type="text" name="phone" placeholder="Nhập số điện thoại"></div>
				<div><input type="text" name="address" placeholder="Nhập địa chỉ"></div>
				<button>Đăng Ký</button>
			</form>
			<p class="error" style="text-align: center"></p>
			<span title="Click to close">x</span>
		</div>
	</div>
@stop
@section('category')
	<span class="category">Phong cảnh</span>
@stop
@section('content')
	<div class="container-div">
		<ul>
			@foreach($data['albums'] as $index => $album)
            <li class="item-image">
				<article>
                    <a href='{{Asset('album/view/'.$album->id)}}'><img src="{{url('public/'.$album->image->first()->path)}}" alt="{{$album->title}}"><a>
					<div class="photo_content">
						<p class="title"></p>
						<p class="user_by">{{$album->user->name}}</p>
						<div class="view">
							<span class="like"><i>d</i> <span>{{$album->sum_like}}</span></span>
							<span><i class='glyphicon glyphicon-share'></i>{{$album->sum_share}}</span>
						</div>
					</div>
				</article>
			</li>
            @endforeach
			
			
		</ul>
	</div>
@stop
