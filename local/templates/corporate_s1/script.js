var CCorporateTopMenuClone = false;
var CCorporate = {
    responsiveMenuClone: false,
    
    responsiveMenu: function() {
        var w = window.innerWidth
            || document.documentElement.clientWidth
            || document.body.clientWidth;
            
        if (window.CCorporateTopMenuClone == false)
            window.CCorporateTopMenuClone = $("#top-menu").clone();
        
        if (w <= 960)
            return;
        
        $("#top-menu").html(window.CCorporateTopMenuClone.html());

        var containerWidth = parseInt($("#top-menu").width()),
            sumWidth = 80,
            index = 0,
            startRemove = false,
            removeItems = [];
                
        
        $("#top-menu > .item").each(function () {
            sumWidth += parseInt($(this).width());
            
            if (containerWidth <= sumWidth)
            {
                
                startRemove = true;
            }
                
            
            if (startRemove)
            {
                removeItems.push($(this));
                $(this).remove();
            }
            
            index++;
        });
        
        if (removeItems.length > 0)
        {
            var moreItem = $('<div class="item more"><a href="javascript:void(0)" class="link"></a><div class="sub"></div></div>');
            var subItems = moreItem.find('.sub');
            $.each(removeItems, function (index, el) {
                subItems.append(el);
            });
            $("#top-menu").append(moreItem);
        }
        
    },
    
    toBasket: function (element, productId, quantity) {
        var valQuantity = 1, self = this;
        
        productId = (productId) || 0;
        
        if (typeof quantity == 'string')
            valQuantity = parseInt($("#" + quantity).val());
        else
            valQuantity = parseInt(quantity);
        
        if (isNaN(valQuantity))
        {
            valQuantity = 1;
        }
        //alert(BX.message('SITE_DIR'));
        $.ajax({
            url: BX.message('SITE_DIR') + 'include/ajax/to_basket.php',
            data: {
                id: parseInt(productId),
                qty: valQuantity
            },
            success: function (data) {
                $(element).addClass('in-basket').text($(element).data('in-basket-text'));
                self.reloadBasket();
            }
        });
    },
    
    reloadBasket: function () {
        $.ajax({
            url: BX.message('SITE_DIR') + 'include/ajax/basket.php',
            success: function (data) {
                $("#header-basket").html(data);
            }
        });
    },
    
    openCatalogTab: function (element, tab) {
        var tab = $("#" + tab);
        if (tab.length > 0) {
            tab.parent().find('> .tab-content').removeClass('active');
            tab.addClass('active');

            element = $(element);
            element.parent().find('> a').removeClass('active');
            element.addClass('active');
        }
    }
};


$( document ).ready(function() {
    
    CCorporate.responsiveMenu();
    
    $( window ).resize(function() {
        CCorporate.responsiveMenu();
    });
    
    $("body").on('click', '.side-menu .item.has-sub .link', function (event) {
        event.preventDefault();
        $(this).parent().siblings().removeClass('active');
        $(this).parent().toggleClass('active');
        return false;
    });
    
    $("body").on('click', '.accordion .item .name', function (event) {
        event.preventDefault();
        $(this).parent().siblings().removeClass('active');
        $(this).parent().toggleClass('active');
        return false;
    });

    $('body').on('click', '.mobile-menu', function (event) {
        event.preventDefault();
        $(this).toggleClass('open');
        $(this).find(".mobile-menu-icon").toggleClass('open');
        $(this).siblings().toggleClass('open');
    });

    $('body').on('click', '.search-icon', function (event) {
        event.preventDefault();
        $(this).toggleClass('active');
        $("#top-menu").toggleClass('search-open');
        $(".search").toggleClass('open');
    });

    if(document.documentElement.clientWidth <= 960) {
        $('body').on('click', ".menu .item.has-sub > .link", function() {
            event.preventDefault();
            $(this).parent().toggleClass('open');
            $(this).parent().siblings().removeClass('open');
        });
    }
    
    $("body").on('click', '.quantity-selector .plus, .quantity-selector .minus', function(event) {
        event.preventDefault();
        var input = $(this).parents('.quantity-selector').find('input:text'),
            value = parseInt(input.val());
        
        if (isNaN(value))
            value = 1;
        
        if ($(this).hasClass('plus'))
            input.val(value + 1);
        else if ($(this).hasClass('minus'))
        {
            if (value - 1 < 1)
                input.val(1);
            else
                input.val(value - 1);
        }
        
        input.trigger('change');
        
        return false;
    });
    
    $("body").on('click', '.popup [data-close]', function (event) {
        event.preventDefault();
        var popup = $(this).parents('.popup');
        if (popup.hasClass('inline')) popup.hide();
        else popup.jqmHide();
        return false;
    });

    $("body").on('click', '.smart-filter .bx_filter_title', function (event) {
        event.preventDefault();
        var filter = $(this).parents('.smart-filter');
        if (filter.hasClass('active')) {
            filter.removeClass('active')
                  .css('top', '24.3vh');
        } else {
            filter.addClass('active')
                  .css('top', pageYOffset + document.documentElement.clientHeight / 4);
        }
    });

    if (document.documentElement.clientHeight < 860) {
        var filter = $('.smart-filter');
        filter.addClass('hide');
        window.onscroll = function() {
          if (window.pageYOffset > 300) {
            filter.removeClass('hide');
          } else {
            filter.addClass('hide');
          }
        };
    }


    
    jqmPopup('callback', 'include/ajax/forms/callback.php');
    jqmPopup('ask', 'include/ajax/forms/ask.php');
    jqmPopup('detailed-review', 'include/ajax/forms/detailed-review.php');
});