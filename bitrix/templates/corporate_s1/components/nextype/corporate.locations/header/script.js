
if(window.jQuery) {
    $(document).ready(function(){
        $("body").on('click', '.header-change-city .open-cities-modal', function (event) {
            event.preventDefault();
            $(".cities-modal").toggleClass('open');
            return false;
        });
        
        $("body").on('click', '.header-change-city .open-cities-modal-accept', function (event) {
            event.preventDefault();
            $(".header-change-city .accept-modal").removeClass('open');
            $(".header-change-city .cities-modal").addClass('open');
            return false;
        });
        
        $("body").on('click', '.header-change-city .close-accept-modal', function () {
            $(".header-change-city .accept-modal").removeClass('open');
        });
        
        $("body").on('click', '.header-change-city .set-cookie', function () {
            $.ajax({
                url: BX.message('CURRENT_PAGE') + '?city-select=Y'
            });
        });
        
        
        $(document).click(function(event) {
            if ($(event.target).closest(".header-change-city .cities-modal").length) return;
            
            $(".header-change-city .cities-modal").removeClass('open');
            event.stopPropagation();
        });
    });
    
    
}
