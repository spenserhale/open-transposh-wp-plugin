(function ($) { 
    $(function () {
        // makes the languages sortable, with placeholder, also prevent unneeded change after sort
        $("#sortable").sortable({
            placeholder: "highlight"
        });
        $("#sortable").disableSelection();
    });
}(jQuery)); 