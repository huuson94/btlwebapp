$(document).ready(function(){
    var $container = $('.container-div');
    $container.imagesLoaded(function () {
        $container.masonry({
            itemSelector: '.item-image',
            columWidth: 200
        });
    });
});