function editInPlace() {
    var divHtml = $(this).html();
    //var $style=$(this).attr('style');
    var editableText = $('<input type="text" class="form-control" />');
    editableText.val(divHtml);
    editableText.data("prev-value", divHtml);
    $(this).each(function () {
        $.each(this.attributes, function (i, a) {
            editableText.attr(a.name, a.value);
        })
    })
    editableText.addClass('form-control');
    $(this).replaceWith(editableText);
    editableText.focus();
    // setup the blur event for this new textarea
    editableText.blur(updateInPlace);
    editableText.keydown(function (e) {
        if (e.keyCode == 13) {
            e.preventDefault();
            editableText.blur();
            return false;
        }
    });
}

function updateInPlace(e) {
    var loading = '<i class="fa fa-refresh fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>';
    var $this = $(this);
    var html = $this.val();
    if (html == "") {
        e.preventDefault();
        var alertMessage = $this.data("null-error");
        swal({
            title: alertMessage,
            text: "",
            type: "warning",
            showCancelButton: false,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Ok",
        }).then((isConfirm) => {
            if (isConfirm) {
                html = $this.data("prev-value");
                $this.val(html);
                $this.focus();
                return false;
            }
        });
        return false;
    }
    //var $style=$(this).attr('style');
    var viewableText = $("<p>");
    var token = $('meta[name="csrf-token"]').attr('content');
    var $field = $(this).data('field');
    //alert();
    viewableText.html(html);
    $(this).each(function () {
        $.each(this.attributes, function (i, a) {
            viewableText.attr(a.name, a.value);
        })
    })
    viewableText.removeClass('form-control');
    //$this.replaceWith(loading);
    data = { _method: 'put', _token: token };
    data[$field] = html;
    //*
    $.ajax({
        url: $(this).data('url'),
        type: 'post',
        dataType: 'json',
        data: data,
    }).done(function (data) {
        $this.replaceWith(viewableText);
        viewableText.click(editInPlace);
        //modal.find('.form-msg').html('<div class="alert alert-success"><strong>Success </strong>'+data.msg+'</div>');
    }).fail(function (response) {
        console.log(response.responseText);
        $this.replaceWith(response.responseText);
    });
    //*/


    //$this.replaceWith(viewableText);
    //viewableText.click(editInPlace);
}

function triggerEditInPlace() {
    $(this).prev().trigger("click");
}

$(document).ready(function () {
    var $wrench = $('<i class="fa fa-wrench" class="triggerEditInPlace"></i>');
    $wrench.on('click', triggerEditInPlace);

    $(".editinplace").after($wrench);
    $(".editinplace").click(editInPlace);
    /*
    $(document).find($wrench).each(function() { 
        $(this).click(triggerEditInPlace);
    });
    */

});
