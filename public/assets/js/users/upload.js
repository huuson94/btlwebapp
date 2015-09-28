$(document).ready(function () {
    singleFilesList = [];
    filesCount = 0;
    
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
                        '        ' +
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
    
    function addMultipleFileInput(input){
        input.fileinput({
        showUpload: false,
        showRemove: false,
        uploadUrl: "#",
        minFileCount: 1,
        maxFileCount: 20,
        layoutTemplates: {
            actions: '<div class="file-actions">\n' +
                    '    <div class="file-footer-buttons">\n' +
                    '       {remove} ' +
                    '    </div>\n' +
                    '    <div class="file-upload-indicator" tabindex="-1" title="{indicatorTitle}">{indicator}</div>\n' +
                    '    <div class="clearfix"></div>\n' +
                    '</div>',
            footer: '<div class="file-thumbnail-footer">\n' +
                    '    <div class="file-caption-name" style="width:50%">{caption}</div>\n' +
                    '       <div>'+
                    '           <label class="control-label">Caption</label><textarea class="form-control img-desc" placeholder="Caption for image" name="caption[]"></textarea>'+
                    '       </div>' +
                    '    {actions}\n' +
                    '</div>'
        },
        fileActionSettings:{
            indicatorNew: ""
        },
        });
    }
    
    addSingleFileInput($("form input[type='file'].single"));
    
    addMultipleFileInput($("form input[type='file'].multiple"));
    
    $(document).on('click','.file-preview-frame', function(){
       $(this).prepend('<p class="pull-right"><span class="glyphicon glyphicon-remove delete-image"></span><p>');
    });
    
    $('input.single').on('fileloaded', function (event, file, previewId, index, reader) {
//        setTimeout(updateListName, 0);
        var div = $("div.input-group  div.file-caption-name");
        if(typeof div != "undefined"){
            div.removeClass('file-caption-name');
            div.addClass('show-file-names');
        }
        singleFilesList.push(file);
        updateInputsArray(file);
        updateListName();
    });
    
    $(document).on('change', 'input.single', function(){
//        setTimeout(updateListName, 0);
        
    });
    
    function updateInputsArray(file){
        $("#files-array").append("<input type='hidden' id='for-image-"+filesCount+"' class='file-count' value='1' title='"+file.name+"' name='file_status[]'>");
        filesCount+=1;
    }
    
    function updateListName(){
        var count_images = count_image();
        if(count_images == 0){
            $("div.show-file-names").html('<span class="glyphicon glyphicon-file kv-caption-icon"></span>');
        }
        if(count_images == 1){
            $("div.show-file-names").html('<span class="glyphicon glyphicon-file kv-caption-icon"></span>'+$("#files-array").find('input.file-count[value=1]').attr('title'));
        }else if(count_images > 1){
            $("div.show-file-names").html('<span class="glyphicon glyphicon-file kv-caption-icon"></span>'+count_images+' files selected');
        }
//            var filesCount  = 0;
//            for(filesCount = 0; filesCount < singleFilesList.length; filesCount++){
//               $("#files-array").append("<input type='hidden' id='for-image-"+filesCount+"' class='file-count' value='"+filesCount+"'>"); 
//            }
        
    }
    
    $(document).on('click','span.delete-image', function(){
        var div = $(this).closest('div.file-preview-frame');
        remove_image(div.attr('data-fileindex'));
        div.hide();
        updateListName();
    });
    
    function remove_image(index){
        singleFilesList = $.makeArray(singleFilesList);
        singleFilesList.splice(index,1);
        $("#files-array").find("#for-image-"+index+"").val(0);
    }
    
    function count_image(){
        var count = 0;
        $("#files-array").find('input.file-count[value=1]').each(function(){
            count += 1;
        });
        
        return count;
        
    }
    
//    $(document).on('click', "#upload-image-tabs form .add-image", function () {
//    $('.add-image').click(function(){
//        var thumb = $("#upload-image-tabs form input[type='submit']").closest('p');
//        thumb.before("<div class='upload-image-form'>" + $("div.upload-image-form-template").html() + "</div>");
//        addSingleFileInput(thumb.prev().find("form ul li p > input[type='file'].single").first());
//    });
//    
//    $(document).on('click', "form .delete-image", function () {
//        if(confirm("Do you want to delete this image?")){
//            var div = $(this).closest('div');
//            div.remove();
//        }
//    });
//    
    

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