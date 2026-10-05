jQuery(document).ready(function($) {
    //TOGGLING NESTED ul
    $(".drop-down .selected span").click(function() {
        $(".drop-down .options ul").toggle();
    });

//SELECT OPTIONS AND HIDE OPTION AFTER SELECTION
    $(".drop-down .options ul li a").click(function() {
        var text = $(this).html();
        $(".drop-down .selected span").html(text);
        $(".drop-down .options ul").hide();
    });


//HIDE OPTIONS IF CLICKED ANYWHERE ELSE ON PAGE
    $(document).bind('click', function(e) {
        var $clicked = $(e.target);
        if (! $clicked.parents().hasClass("drop-down"))
            $(".drop-down .options ul").hide();
    });

})