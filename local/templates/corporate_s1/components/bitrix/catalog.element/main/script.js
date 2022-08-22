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
BX.ready(function () {

    var buyBtnDetail = document.body.querySelectorAll('.product-purchase__button');

    for (var i = 0; i < buyBtnDetail.length; i++) {
        BX.bind(buyBtnDetail[i], 'click', BX.delegate(function (e) {
            add2basketDetail(e)
        }, this));

    }


    function add2basketDetail(e) {
        var id = e.target.dataset.product,
            quantity = 1;

        quantity =parseInt(BX('basket-quantity').value);

        //Если товар есть на складе хоть в 1шт, то его можно купить в неограниченном количестве(желание заказщика)
        if(e.target.dataset.quantity>0)
            e.target.dataset.quantity = 10000;

        if (!!BX('QUANTITY_' + id)) {
            quantity = BX('QUANTITY_' + id).value;
        }
        if(e.target.dataset.quantity >= quantity)
        {
            BX.ajax({
                url: window.location.href,
                data: {
                    action: 'ADD2BASKET',
                    ajax_basket: 'Y',
                    quantity: quantity,
                    id: e.target.dataset.product
                },
                method: 'POST',
                dataType: 'json',
                onsuccess: function (data) {
                    if (data.STATUS == 'OK') {
                        BX.addClass(e.target, 'in-basket');
                        e.target.textContent = "Добавлен";

                        ym(49028345,'reachGoal','RelatedPopup_AddToShoppingCart');
                        BX.onCustomEvent('OnBasketChange');
                        //dataLayerAddBasket(e.target.dataset.name, e.target.dataset.price, quantity);


                    } else {
                        console.log(data);

                    }
                }
            });
        }else{
            console.log(e.target.dataset.quantity);
            console.log(quantity);
        }
    }







});