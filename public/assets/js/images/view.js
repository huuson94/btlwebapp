$(document).ready(function(){
	//NiceScroll
	$(".commentList").niceScroll({ 
		zindex: 1000000, 
		cursorborderradius: "4px", // Làm cong các góc của scroll bar
		cursorcolor: "#EA6A48", // Màu của scroll bar
		cursorwidth:"10px", // Kích thước bề ngang của scroll bar
		autohidemode:true   //Tắt chế độ tự ẩn của scroll bar
	});
	var kt=0;
	$('.titleBox').click(function(){
		$('.actionBox').toggle();
		if (kt==0) {
			$('.titleBox span').text('(Click để xem	)');
			kt=1;
		}else{
			$('.titleBox span').text('(Click để thu gọn)');
			kt=0;
		};
	});
	var formData = new FormData($('#comment-form')[0]);
	formData.append('id', id);
	alert(id);
	$('#comment-form').submit(function(e){
		e.preventDefault();
		var obj = $(this);
		$.ajax({
				url: $(this).attr('action'),
				data: formData,
				type: 'POST',
				contentType: false,
				processData: false,
				cache: false,
			}).done(function(data){
				if(data=='success'){
					var str=$('.form-control').val();

					$('.commentList').prepend(str);
				}else{
					obj.next().html('<p>* Chưa comment được 1</p>');
				}
			}).fail(function(){
				alert('* Chưa comment được 2');
			});
	});        
})