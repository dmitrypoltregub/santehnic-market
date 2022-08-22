if(window.jQuery) {
    
    $(document).ready(function(){
        $("body").on('change', '#order_form #order_agreement', function () {
            if ($(this).is(":checked"))
                $("#order_form #form_submit").removeAttr('disabled');
            else
                $("#order_form #form_submit").attr('disabled', 'disabled');
        });
        
        
    });
    
    
}