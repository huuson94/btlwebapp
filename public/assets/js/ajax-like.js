$(document).ready(function(){
    var count_click = 0;
    window.setInterval(function(){count_click = 0}, 5000);
   $("i.like").click(function(){
       count_click ++;
       if(count_click <= 3){
            var url = $(this).attr('itemref');
            var count = parseInt($(this).next('span.count-like').text());
            var obj = $(this);
            $.ajax({
               url:url,
               type: 'PATCH',
               data:{
                   _method: 'PATCH',

               }, 
               success: function(result){
                   if(result == 'true'){
                       count += 1;
                       obj.next('span.count-like').text(count);
                   }
               }
            });
        }else{
            alert('Like không hợp lệ');
            count_click = 0;
        }
   }) ;
});