if(window.jQuery) {
    
    $(document).ready(function(){
        $("body").on('click', '.product .thumbnails .thumb', function () {
            var preview = $(this).data('preview'), detail = $(this).data('detail');
            if (preview != "" && detail != "")
            {
                $(this).parents('.thumbnails').find('.thumb').removeClass('active');
                $(this).addClass('active');
                
                $("#product-main-img").attr('href', detail).find('img').attr('src', preview);
            }
        });
    });
    
    
}