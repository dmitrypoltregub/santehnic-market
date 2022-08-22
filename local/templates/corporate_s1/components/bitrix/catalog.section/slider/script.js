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

                        BX.onCustomEvent('OnBasketChange');
                        dataLayerAddBasket(e.target.dataset.name, e.target.dataset.price, quantity);
                        $('.header-basket').popUp();

                    } else {
                        console.log(data);
                        $('.header-basket-none').popUp();
                    }
                }
            });
        }else{$('.header-basket-none').popUp();}
    }







});