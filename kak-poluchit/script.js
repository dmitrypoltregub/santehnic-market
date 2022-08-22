$(function() {
    $(".delivery").on("click", ".delivery__tab:not(.delivery__tab--active)", function() {
        $(this)
            .addClass("delivery__tab--active")
            .siblings()
            .removeClass("delivery__tab--active")
            .closest(".delivery")
            .find(".delivery__box")
            .removeClass("delivery__box--active")
            .eq($(this).index())
            .addClass("delivery__box--active");
    });

});