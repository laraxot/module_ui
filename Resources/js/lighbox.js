// Lighbox text
$('.popup-text').magnificPopup(
    {
        removalDelay: 500,
        closeBtnInside: true,
        callbacks: {
            beforeOpen: function () {
                this.st.mainClass = this.st.el.attr('data-effect');
            }
        },
        midClick: true
    }
);

$('.popup-ajax').magnificPopup(
    {
        removalDelay: 500,
        closeBtnInside: true,
        callbacks: {
            beforeOpen: function () {
                this.st.mainClass = this.st.el.attr('data-effect');
            },
            open: function () {
                var popup = this;
                var content = this.content;

                var ajax_url = this.st.el.attr('data-src');
                var target = this.st.el.attr('href');

                if (content.data('ajax_url') === ajax_url) {
                    content.addClass('ajax-loaded');
                    return;
                }

                content.children('.row, hr, a.btn-primary').remove();
                content.html("<i class=\"fa fa-refresh fa-spin\"><\/i>");

                //*
                $.get(
                    ajax_url, {
                        target: target
                    }, function (response) {
                        //alert(response);
                        //content.children( '.fa' ).remove();
                        //content.prepend( response );
                        content.html(response);
                        //popup.content.html( $.trim(response) );
                        popup.content.data('ajax_url', ajax_url).addClass('ajax-loaded');
                    }
                );
                //*/
                /*
                $.ajax({
                url: ajax_url,
                target:target,
                method:'get',
                success: function(result){
                popup.content.html(result);
                }
                });
                */

            },
            close: function () {
                this.content.removeClass('ajax-loaded');
            }
        },
        midClick: true
    }
);

$('.new-ajax-popup-link').magnificPopup(
    {
        type: 'ajax',
        removalDelay: 500,
        closeBtnInside: true
    }
);

var mfp = $.magnificPopup;

$('.ajax-popup-link1').on(
    'click', function (e) {
        e.preventDefault();
        var $href = $(this).attr('href');

        mfp.open(
            {
                type: 'inline',
                closeOnContentClick: false,
                items: {
                    src: $href
                }
            }
        );
        return false;

    }
);


$('.ajax-popup-link').magnificPopup(
    {
        type: 'ajax',
        removalDelay: 500,
        closeBtnInside: true,
        modal: false,
        enableEscapeKey: true,

        callbacks: {
            beforeOpen: function () {
                //alert('beforeOpen');
                //    this.st.mainClass = this.st.el.attr('data-effect');
            },
            open: function () {
                /*
                alert('Open');
                $('.new-ajax-popup-link').on('click', function(e) {
                alert('cli1');
                  e.preventDefault();
                // close current popup
                  $.magnificPopup.close();
                  return false;
                });
                //*/
            },
            afterClose: function () {
                //alert('afterClose');
                // new popup instance
                /*
                var newAjaxPopupLink = $('.ajax-popup-link').magnificPopup({
                  type: 'ajax'
                });
                // open it
                $('.ajax-popup-link').magnificPopup('open');
                */
            },
            parseAjax: function (ajaxResponse) {
                ajaxResponse.data = '<div class="mfp-with-anim mfp-dialog clearfix">' + ajaxResponse.data + '</div>';
            },
            ajaxContentAdded: function () {
                $('.ajax-popup-link').on(
                    'click', function (e) {
                        e.preventDefault();
                        var $href = $(this).attr('href');
                        mfp.open(
                            {
                                type: 'inline',
                                removalDelay: 500,
                                closeBtnInside: true,
                                closeOnContentClick: false,
                                items: {
                                    src: $href
                                }
                            }
                        )
                        return false;
                    }
                );
                $.ajaxSetup(
                    {
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    }
                );

                $(".dialog-form").submit(
                    function (e) {
                        //prevent Default functionality
                        var myform = $(this);
                        var querystring = myform.serialize();
                        //remember_me:$('input[name=remembre_me]').is(':checked')
                        //alert(myform.serialize());
                        e.preventDefault();
                        //get the action-url of the form
                        var actionurl = e.currentTarget.action;
                        $('.loginRes').html("<i class=\"fa fa-refresh fa-spin\"><\/i>");
                        //alert(actionurl);
                        //do your own request an handle the results
                        $.ajax(
                            {
                                url: actionurl,
                                type: 'post',
                                dataType: 'json',
                                data: querystring,
                                success: function (response) {
                                    /*
                                    if(data.status==0){
                                    $('.loginRes').html('<div class="alert alert-danger" role="alert">'+data.msg+'</div>');
                                    }else{
                                    $('.loginRes').html('<div class="alert alert-success" role="alert">'+data.msg+'</div>');
                                    if(myform.attr('id')=='formLogin'){
                                    location.reload();
                                    }
                                    }
                                    */
                                    //console.log(response);
                                    //alert(response);
                                    $('.loginRes').html('<div class="alert alert-success" role="alert">' + response.msg + '</div>');
                                    window.location.href = response.redirect;
                                    // ... do something with the data...
                                },
                                error: function (response) {
                                    console.log(response);
                                    var errors = response.responseJSON.errors;
                                    var $err_msg='<ul>';
                                    for (var key in errors) {
                                        //console.log(key+' : '+myform.find('[id="'+key+'"]').length );
                            
                                        myform.find('[id="' + key + '_error"]').remove();

                                        myform.find('[id="'+key+'"]').parent('.form-group').append(
                                            '<span id="' + key + '_error" class="help-block">\n' +
                                            '\t\t\t<strong>' + errors[key] + '</strong>\n' +
                                            '\t\t</span>'
                                        );
                                        $err_msg=$err_msg+'<li>'+errors[key]+'</li>';
                                    }
                                    var $err_msg=$err_msg+'</ul>';
                                    $('.loginRes').html('<div class="alert alert-danger" role="alert">'+$err_msg+'</div>');
                                }
                            }
                        );

                        return false;
                    }
                );

            }


        },
        midClick: true
    }
);


$('a.ajax-popup-link2').on(
    'click', function (e) {
        //alert();
        //*
        var $obj = $(this);
        var $href = $(this).attr('href');
        e.preventDefault();
        $.ajax(
            {
                type: "GET", // or POST
                url: $href,
                /*
                data: {
                get_request_id : $(this).data('id'), // assign a data-id to the link
                },
                */
                success: function (data) {
                    //$.magnificPopup.open({
                    $obj.magnificPopup(
                        {
                            type: 'inline',
                            closeOnContentClick: false,
                            items: {
                                src: data
                            }
                        }
                    )
                }
            }
        );

    }
);
