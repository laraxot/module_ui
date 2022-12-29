
$('[data-toggle="tooltip"]').tooltip(); 
$('table').addClass('table table-striped table-bordered table-hover table-condensed');
var current_title;
$(window).blur(
    function () {
        //var current_href = $(location).attr('href');
        current_title = $(document).attr('title');
        $(document).attr("title", "Torna Qua !");
    }
);
$(window).focus(
    function () {
        $(document).attr("title", current_title);
    }
); 


//-------------------------------------------------------
$('.collapse').collapse();
$('#multiselect').multiselect();

 //------------------------------------------------------
 /*
 $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
*/
$('.dropzone').html5imageupload(
    {
        onAfterProcessImage: function () {
            alert('onAfterProcessImage');
            var $val=$(this.element).data('name');
            $('#{{ $name }}').val($val);
        },
        onAfterCancel: function () {
            alert('onAfterCancel');
            $('#{{ $name }}').val('');
        }
    }
);


 //$('.metismenu').metisMenu();
