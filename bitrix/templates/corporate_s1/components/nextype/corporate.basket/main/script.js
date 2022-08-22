if(window.jQuery) {
    
    $(document).ready(function(){
        $("body").on('update', '#basket-full-container', function () {
            $.ajax({
                url: BX.message('CURRENT_PAGE'),
                data: {is_ajax: 'basket-full-container'},
                success: function (data) {
                    $("#basket-full-container").html(data);
                }
            });
            
            if (typeof CCorporate == 'object') {
                CCorporate.reloadBasket();
            }
        });
        
        $("body").on('click', '#basket-full-container .clear-basket', function () {
            $.ajax({
               url: BX.message('BASKET_FULL_AJAX_PATH') + '/in_basket_call.php',
               data: {
                   action: 'clear'
               },
               success: function (data) {
                   window.location.reload(true);
               }
            });
            
        });
        
        $("body").on('click', '#basket-full-container [data-delete]', function () {
            var id = $(this).data('delete');
            
            if (id != "") {
                $.ajax({
                   url: BX.message('BASKET_FULL_AJAX_PATH') + '/in_basket_call.php',
                   data: {
                       action: 'delete',
                       id: id
                   },
                   success: function (data) {
                       data = JSON.parse(data);
                       if (data.result == 'ok')
                            $("#basket-full-container").trigger('update');
                       else
                           window.location.reload(true);
                   }
                });
            }
            
        });
        
        $("body").on('change', '#basket-full-container [data-qty]', function () {
            var id = $(this).data('qty'), value = $(this).val();

            if (id != "") {
                $.ajax({
                   url: BX.message('BASKET_FULL_AJAX_PATH') + '/in_basket_call.php',
                   data: {
                       action: 'update',
                       id: id,
                       qty: value
                   },
                   success: function (data) {
                       $("#basket-full-container").trigger('update');
                   }
                });
            }
            
        });
        
    });
    
    
}