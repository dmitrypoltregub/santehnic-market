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
        //Если товар есть на складе хоть в 1шт, то его можно купить в неограниченном количестве(желание заказщика)
        if(e.target.dataset.quantity>0)
            e.target.dataset.quantity = 10000;

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
                        console.log(e.target.textContent);

                        BX.onCustomEvent('OnBasketChange');
                        ym(49028345,'reachGoal','RelatedPopup_AddToShoppingCart');

                        //dataLayerAddBasket(e.target.dataset.name, e.target.dataset.price, quantity);
                        //$('.ask-popup').popUp();

                    } else {
                        console.log(data);
                        alert("Товар уже добавлен или отсутствует на складе!");
                        $('.header-basket-none').popUp();
                    }
                }
            });
        }else{$('.header-basket-none').popUp();}
    }







});