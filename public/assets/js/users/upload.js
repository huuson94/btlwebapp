$(document).ready(function () {
    $("#upload-tabs").tabs();
    function addSingleFileInput(input){
        input.fileinput({
        'showUpload':false,
        'showRemove':false,
         minFileCount: 0,
        maxFileCount: 20,
        uploadUrl: "#",
        layoutTemplates: {
            actions: '<div class="file-actions">\n' +
                        '    <div class="file-footer-buttons">\n' +
                        '        {delete}' +
                        '    </div>\n' +
                        '    <div class="file-upload-indicator" tabindex="-1" title="{indicatorTitle}">{indicator}</div>\n' +
                        '    <div class="clearfix"></div>\n' +
                        '</div>',
            footer: '<div class="file-thumbnail-footer">\n' +
                    '    <div class="file-caption-name" style="width:50%">{caption}</div>\n' +
                    $("div.upload-image-form-template").html()+
                    '    {actions}\n' +
                    '</div>'
        }
    });
    }
//    $(document).on('click', "#upload-image-tabs form .add-image", function () {
    $('.add-image').click(function(){
        var thumb = $("#upload-image-tabs form input[type='submit']").closest('p');
        thumb.before("<div class='upload-image-form'>" + $("div.upload-image-form-template").html() + "</div>");
        addSingleFileInput(thumb.prev().find("form ul li p > input[type='file'].single").first());
    });
    
    $(document).on('click', "form .delete-image", function () {
        if(confirm("Do you want to delete this image?")){
            var div = $(this).closest('div');
            div.remove();
        }
    });
    
    addSingleFileInput($("form input[type='file'].single"));
    
    $("form input[type='file'].multiple").fileinput({
        showUpload: false,
        showRemove: false,
        uploadUrl: "#",
        minFileCount: 1,
        maxFileCount: 20,
        layoutTemplates: {
            actions: '<div class="file-actions">\n' +
                    '    <div class="file-footer-buttons">\n' +
                    '        {delete}' +
                    '    </div>\n' +
                    '    <div class="file-upload-indicator" tabindex="-1" title="{indicatorTitle}">{indicator}</div>\n' +
                    '    <div class="clearfix"></div>\n' +
                    '</div>',
            footer: '<div class="file-thumbnail-footer">\n' +
                    '    <div class="file-caption-name" style="width:50%">{caption}</div>\n' +
                    '       <div>'+
                    '           <label class="control-label">Description</label><textarea class="form-control img-desc" placeholder="Description for image" name="image_description[]"></textarea>'+
                    '       </div>' +
                    '    {actions}\n' +
                    '</div>'
        },
        fileActionSettings:{
            indicatorNew: ""
        },
    });
    
    $("input[type='file']").on("filepredelete", function(jqXHR) {
        var abort = true;
        if (confirm("Are you sure you want to delete this image?")) {
            abort = false;
        }
        return abort; // you can also send any data/object that you can receive on `filecustomerror` event
     });


//    function previewSingle(input, preview) {
//        if (input.files && input.files[0]) {
//            var reader = new FileReader();
//
//            reader.onload = function (e) {
//                preview.attr('src', e.target.result);
//            }
//
//            reader.readAsDataURL(input.files[0]);
//        }
//    }
//    
//    $(document).on('change', "form input[type='file'].single", function () {
//        var preview = $(this).parent().next().find('img');
////        previewSingle(this, preview);
//    });
//    
    
//    $(document).on('change', "form input[type='file'].multiple", function(evt){
//        var files = evt.target.files; // FileList object
//        var anyWindow = window.URL || window.webkitURL;
//        for(var i = 0; i < files.length; i++){
//          var objectUrl = anyWindow.createObjectURL(files[i]);
//          console.log(objectUrl);
//          $('div.album-preview').append("<p class='preview'><img class='preview img-rounded' src='"+objectUrl+"'></p>");
//          // get rid of the blob
//          window.URL.revokeObjectURL(files[i]);
//        }
//    });
//    
//    $(document).on('click', "p.preview", function(){
//       $(this).remove(); 
////       /$("form input[type='file'].multiple").files  
//    });
});