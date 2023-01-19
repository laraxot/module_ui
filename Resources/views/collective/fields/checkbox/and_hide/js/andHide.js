//$('.toggle_hide').
$('.toggle_hide').click(
    function () {
        if ($(this).prop("checked") == true) {
            $('.to_hide').hide();
        } else if ($(this).prop("checked") == false) {
            $('.to_hide').show();
        }
    }
);
