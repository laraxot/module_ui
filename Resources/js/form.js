require('tinymce');
//*
require('tinymce/themes/silver');
require('tinymce/plugins/paste');
require('tinymce/plugins/advlist');
require('tinymce/plugins/autolink');
require('tinymce/plugins/lists');
require('tinymce/plugins/link');
require('tinymce/plugins/image');
require('tinymce/plugins/charmap');
require('tinymce/plugins/print');
require('tinymce/plugins/preview');
require('tinymce/plugins/anchor');
require('tinymce/plugins/textcolor');
require('tinymce/plugins/searchreplace');
require('tinymce/plugins/visualblocks');
require('tinymce/plugins/code');
require('tinymce/plugins/fullscreen');
require('tinymce/plugins/insertdatetime');
require('tinymce/plugins/media');
require('tinymce/plugins/table');
require('tinymce/plugins/contextmenu');
require('tinymce/plugins/code');
require('tinymce/plugins/help');
require('tinymce/plugins/wordcount');
//*/
$(document).ready(
    function () {
        var editor_config = {
            document_base_url : base_url,
            path_absolute : '/',
            relative_urls: true,
            convert_urls : true,
            selector: ".tinymce",
            plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table directionality",
            "emoticons template paste textpattern",
            "codesample"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | code codesample | fullscreen",
            codesample_languages: [
            {text: 'bash',              value: 'bash'       },
            {text: "git",               value: "git"        },
            {text: "SQL",               value: "sql"        },
            {text: 'HTML/XML',          value: 'markup'     },
            {text: 'JavaScript',        value: 'javascript' },
            {text: 'CSS',               value: 'css'        },
            {text: 'PHP',               value: 'php'        },
            {text: 'Ruby',              value: 'ruby'       },
            {text: 'Python',            value: 'python'     },
            {text: 'Java',              value: 'java'       },
            {text: 'C',                 value: 'c'          },
            {text: 'C#',                value: 'csharp'     },
            {text: 'C++',               value: 'cpp'        }
            ],
            file_picker_callback: function (callback, value, meta) {
                let x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                let y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

                let type = 'image' === meta.filetype ? 'Images' : 'Files',
                url  = editor_config.path_absolute + 'laravel-filemanager?editor=tinymce5&type=' + type;

                tinymce.activeEditor.windowManager.openUrl(
                    {
                        url : url,
                        title : 'Filemanager',
                        width : x * 0.8,
                        height : y * 0.8,
                        onMessage: (api, message) => {
                            callback(message.content);
                        }
                    }
                );
            }
        };

        tinymce.init(editor_config);



    }
);

/*
https://packagist.org/packages/emilianotisato/nova-tinymce
          ",
      "     ",
      "      ",
      "     "
*/