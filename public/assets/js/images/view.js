$(document).ready(function () {
    //NiceScroll
    $(".commentList").niceScroll({
        zindex: 1000000,
        cursorborderradius: "4px", // Làm cong các góc của scroll bar
        cursorcolor: "#EA6A48", // Màu của scroll bar
        cursorwidth: "10px", // Kích thước bề ngang của scroll bar
        autohidemode: true   //Tắt chế độ tự ẩn của scroll bar
    });
    var kt = 0;
    $('.titleBox').click(function () {
        $('.actionBox').toggle();
        if (kt == 0) {
            $('.titleBox span').text('(Click để xem	)');
            kt = 1;
        } else {
            $('.titleBox span').text('(Click để thu gọn)');
            kt = 0;
        }
        ;
    });
    
    $('#comment-form').submit(function (e) {
        var formData = new FormData($('#comment-form')[0]);
        e.preventDefault();
        var obj = $(this);
        $.ajax({
            url: $(this).attr('action'),
            data: formData,
            type: 'POST',
            contentType: false,
            processData: false,
            cache: false,
        }).done(function () {
        	// alert('comment thanh cong');
        	var cmt_content=$('textarea.form-control').val();
        	var str = "<li><p>"+username+"</p><div class=\"commentText\"><p>"+cmt_content+"</p><span class=\"date sub-text\">on"+post_time+"</span></div></li>";
        	$('ul.commentList').prepend(str);
         	$('.form-control').val('');
        }).fail(function () {
            alert('* Bạn không có quyền bình luận !');
        });
    });
})