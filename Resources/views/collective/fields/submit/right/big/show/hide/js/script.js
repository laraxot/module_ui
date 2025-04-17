function checkInput() {

    /* let emptyInputsNumber = $('#mainForm input').not('#mainForm input[type="checkbox"]').not('[id^=html5]').filter(function () {
         return !this.value;
     });*/


    let passForm = false;

    if ($("#upload_date").val() !== '' && $("#description").val() !== '' &&
        $('#territorial_level').val() !== '' && $("#path_14").val() !== '') {
        passForm = true;
    }

    if (passForm === true) {
        $("#submitButton").removeAttr('disabled');
    } else {
        $("#submitButton").attr('disabled', 'disabled');
    }

}

$('#mainForm input').not('#mainForm input[type="checkbox"]').on('input', checkInput);

$('#mainForm input').not('#mainForm input[type="checkbox"]').on('change', checkInput);

$('#mainForm').submit(function (event) {

    event.preventDefault();

    upload_files_old($(this));

});

function upload_files_old(form) {
    let i = 0;

    function run() {

        if (generalUploader[i] !== undefined && generalUploader[i].files !== undefined && generalUploader[i].files.length > 0) {

            generalUploader[i].start();

            generalUploader[i].bind('UploadComplete', function (up, file) {

                let percentage = 8.33 * (i + 1);

                percentage = percentage.toFixed(2);

                $('.progress-bar').css('width', percentage + "%");
                $('.progress-bar').html(percentage + "%");

                i++;

                run();

            });
        } else if (i < 11) {
            i++;

            run();
        } else {
            //TOGLIERE
            form.unbind('submit').submit();
        }
    }

    //TOGLIERE
    $("#submitButton").addClass('d-none');
    $('#upload_progress').removeClass('d-none');
    $('#upload_tab').addClass('d-none');

    let percentage = 8.33;

    percentage = percentage.toFixed(2);

    $('.progress-bar').css('width', percentage + "%");
    $('.progress-bar').html(percentage + "%");

    run();
}
