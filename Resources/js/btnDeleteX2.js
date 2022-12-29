//https://gist.github.com/crystrk/32f1fb5d32102537e534b75d443ae297
var deleter = {

    //linkSelector          : "a[data-delete]",
    linkSelector          : "a.btn-danger",
    modalTitle            : "Are you sure?",
    modalMessage          : "You will not be able to recover this entry?",
    modalConfirmButtonText: "Yes, delete it!",
    laravelToken          : null,
    url                   : "/",

    init: function () {
        $(this.linkSelector).on('click', {self:this}, this.handleClick);
    },

    handleClick: function (event) {
        event.preventDefault();
        
        var self = event.data.self;
        var link = $(this);

        self.modalTitle             = link.data('title') || self.modalTitle;
        self.modalMessage           = link.data('message') || self.modalMessage;
        self.modalMessage           = self.modalMessage + '['+link.data('id')+']';
        self.modalConfirmButtonText = link.data('button-text') || self.modalConfirmButtonText;
        //self.url                    = link.attr('href');
        self.url                    = link.data('href');
        self.laravelToken           = $("meta[name=csrf-token]").attr('content');

        self.confirmDelete();

    },

    confirmDelete: function () {
        Swal.fire(
            {
                title             : this.modalTitle,
                text              : this.modalMessage,
                type              : "warning",
                showCancelButton  : true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText : this.modalConfirmButtonText //,
                //closeOnConfirm    : true
            }
        ).then(
            function (isConfirm) {
                if (isConfirm.value) {
                    //alert('SI');
                    this.makeDeleteRequest();
                }else{
                     //alert('NO');
                }
            }.bind(this)
        );
    },
    makeDeleteRequest: function () {
        $.ajax(
            {
                url: this.url,
                type: "DELETE",
                data: {_method: 'delete',_token :this.laravelToken},
                success: function (data) {
                      console.log(data);
                      //$("#task" + task_id).remove();
                      //alert(data);
                      Swal.fire("Deleted!", "Your imaginary file has been deleted.", "success");
                      location.reload();
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) { 
                    console.log('url : '+this.url);
                    console.log('XMLHttpRequest');
                    console.log(XMLHttpRequest);
                    //alert(XMLHttpRequest.responseText);
                    $('#div_debug').html(XMLHttpRequest.responseText);
                    console.log('textStatus');
                    console.log(textStatus);
                    console.log('errorThrown');
                    console.log(errorThrown);
                    alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                }//end error
            }
        );
    },
    makeDeleteRequest1: function () {
        var form =
        $(
            '<form>', {
                'method': 'POST',
                'action': this.url
            }
        );

        var token =
        $(
            '<input>', {
                'type': 'hidden',
                'name': '_token',
                'value': this.laravelToken
            }
        );

        var hiddenInput =
        $(
            '<input>', {
                'name': '_method',
                'type': 'hidden',
                'value': 'DELETE'
            }
        );

        return form.append(token, hiddenInput).appendTo('body').submit();
    }
};

deleter.init();