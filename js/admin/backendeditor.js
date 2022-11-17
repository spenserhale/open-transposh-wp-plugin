/*global Date, Math, alert, escape, clearTimeout, document, jQuery, setTimeout, t_jp, t_be, window */
(function ($) { 
    // If we have a single post, we can just go through with it
    $(function () {
        $.ajaxSetup({
            cache: false
        });

        $(".delete").click(function () {
            var me = this;
            var href = $(this).children().attr('href');
            console.log(href);
            $.ajax({
                url: href,
                dataType: 'json',
                /*data: {
                 action: "tp_translate_all"
                 },*/
                cache: false,
                success: function (data) {
                    if (data) {
                        $(me).parents('tr').hide();
                    } else {
                        $(me).parents('tr').css("background-color", "red");
                    }
                }
            });
            return false;
        });
    });
}(jQuery)); 