(function ($) { 
    $(document).on('click','.tp_help', function (event) {
        event.preventDefault();
        window.scrollTo(0, 0);
        $('#tab-link-' + jQuery(this).attr('rel') + ' a').trigger('click');
        if (!$('#contextual-help-link').hasClass('screen-meta-active'))
            $('#contextual-help-link').trigger('click');
    });
}(jQuery)); 