$(document).ready(function(){
   $("i.like").click(function(){
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
   }) ;
});