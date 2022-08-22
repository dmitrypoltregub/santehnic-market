question = "";

$(document).ready(function() {
    $(document).on('click', '#conditions .tab .head', function() {
        if ($(this).parent().hasClass('active')) { $('#conditions .tab').removeClass('active'); getVisible(); }
        else { getVisible(); $('#conditions .tab').removeClass('active'); $(this).parent().addClass('active'); $(this).next().slideToggle(300); }
    });

    $(document).on('click', '#next_question', function() {
        if ($('.purchase__returns .poll_block label input:radio').is(':checked') && question==$('.purchase__returns .poll_block .question:visible').attr('id').replace('question', '')) {
            question += $('.purchase__returns .poll_block label input:radio:checked').val();
            $('#prev_question').show();
            act();
        }
    });

    $(document).on('click', '#prev_question', function() {
        question = question.slice(0, -1);
        if (question=="") $('#prev_question').hide();
        act();
    });

    $(document).on('click', '#begin', function() {
        question="";
        $('#next_question').show();
        $('.purchase__returns .poll_block label').show();
        act();
    });
});

function getVisible() {
    $('#conditions .tab .body').each(function(i, elem) {
        if ($(elem).is(':visible')) $(elem).slideToggle();
    });
}

function act() {
    $('#begin').hide();
    $('.purchase__returns .poll_block label input:radio').prop('checked', false);
    $('.purchase__returns .poll_block .question').hide();
    if ($('#question' + question).attr('rel')) {
        question = $('#question' + question).attr('rel');
        $('#question' + question).show();
    }
    else {
        $('#question' + question).show();
        if ($('.purchase__returns .poll_block .question:visible').hasClass('alert') || $('.purchase__returns .poll_block .question:visible').hasClass('complete')) {
            $('#next_question').hide();
            $('#prev_question').hide();
            $('#begin').show();
            $('.purchase__returns .poll_block label').hide();
        }
    }
}