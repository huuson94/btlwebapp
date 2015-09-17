$(document).ready(function () {
    $("#upload-image-tabs").tabs();

//    $(document).on('click', "#upload-image-tabs form .add-image", function () {
    $('.add-image').click(function(){
        console.log($(this));
        var thumb = $("#upload-image-tabs form input[type='submit']").closest('p');
        thumb.before("<div class='upload-image-form'>" + $("div.upload-image-form-template").html() + "</div>");
    });
    
    $(document).on('click', "form .delete-image", function () {
        if(confirm("Do you want to delete this image?")){
            var div = $(this).closest('div');
            div.remove();
        }
    });


    function readURL(input, preview) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                preview.attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $(document).on('change', "form input[type='file'].single", function () {
        var preview = $(this).parent().next().find('img');
        readURL(this, preview);
    });

});