let generalUploader = [];

function createUploader(id)
{


    let uploader = new plupload.Uploader(
        {
            runtimes: 'html5,flash,silverlight,html4',
            /* il chunk size va impostato su moxie */
            chunk_size: '500kb',
            browse_button: 'pickfiles_' + id, // you can pass in id...
            container: document.getElementById('mainForm'), // ... or DOM Element itself
            multi_selection: false,
            url: "/upload?_token=" + $('meta[name="csrf-token"]').attr('content'),

            filters: {
                max_file_size: '100mb',
                mime_types: [{
                    title: "PDF files",
                    extensions: "pdf"
                }]
            },

            // Flash settings
            flash_swf_url: base_url + '/bc/plupload/js/Moxie.swf',

            // Silverlight settings
            silverlight_xap_url: base_url + '/bc/plupload/js/Moxie.xap',


            init: {
                PostInit: function () {
                    document.getElementById('filelist_' + id).innerHTML = 'File non selezionato';

                    document.getElementById('pickfiles_' + id).innerHTML = 'Seleziona';

                    /*document.getElementById('uploadfiles_' + id).onclick = function () {
                    uploader.start();
                    return false;
                    };*/
                },

                FilesAdded: function (up, files) {
                    while (up.files.length > 1) {
                        up.removeFile(up.files[0]);
                    }
                    plupload.each(
                        files, function (file) {
                            document.getElementById('filelist_' + id).innerHTML = '<div id="' + file.id + '">File: ' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';

                            $('#pickfiles_' + id).removeClass("btn-danger");
                            $('#pickfiles_' + id).addClass("btn-secondary");

                            document.getElementById('path_' + id).value = file.name;
                            $('#path_' + id).trigger('change');

                            $('input#purposal_flag_' + id).removeAttr('disabled');
                            //$('input[name="purposal_flag[]"][type="checkbox"]').removeAttr('disabled');

                        }
                    );
                },

                UploadProgress: function (up, file) {
                    document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
                },

                Error: function (up, err) {
                    document.getElementById('console_' + id).innerHTML += "\nError #" + err.code + ": " + err.message;
                }
            }
        }
    );

    uploader.init();

    generalUploader.push(uploader);

}
