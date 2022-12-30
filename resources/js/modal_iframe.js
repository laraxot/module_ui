$(function() {
    $('#myModalIframe').on('show.bs.modal',
        function (event)  {
            var button = $(event.relatedTarget); // Button that triggered the modal
		    var title = button.data('title'); // Extract info from data-* attributes
            var url = button.data('href');
            var modal = $(this);
            modal.data('reload',1);
            modal.find('.modal-title').text(title);
            //var url1=setUrlParameter(url,'format','iframe');
            modal.find('iframe').attr('src',url);
        }
    );
    $('#myModalIframe').on('hidden.bs.modal', function (event)  {
		var modal = $(this);
		//if(modal_callback!=undefined){
		//	eval(modal_callback);
		//}
        //modal.find('.modal-body').html('<i class="fa fa-refresh fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>');
        modal.find('iframe').attr('src',base_url+'/html/loading.html');
		if(modal.data('reload')){
			location.reload();
		}
    });

    window.closeIframeModal=function(){
        $('#myModalIframe').modal('hide');
    };
});
/**
 * https://github.com/saribe/eModal
 * https://blog.bitscry.com/2018/08/17/getting-and-setting-url-parameters-with-javascript/
 */

/*
function getUrlParameter(url, parameter){
    parameter = parameter.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
    var regex = new RegExp('[\\?|&]' + parameter.toLowerCase() + '=([^&#]*)');
    var results = regex.exec('?' + url.toLowerCase().split('?')[1]);
    return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g,''));
}

function setUrlParameter(url, key, value) {
    var key = encodeURIComponent(key),
        value = encodeURIComponent(value);

    var baseUrl = url.split('?')[0],
        newParam = key + '=' + value,
        params = '?' + newParam;

    if (url.split('?')[1] === undefined){ // if there are no query strings, make urlQueryString empty
        urlQueryString = '';
    } else {
        urlQueryString = '?' + url.split('?')[1];
    }

    // If the "search" string exists, then build params from it
    if (urlQueryString) {
        var updateRegex = new RegExp('([\?&])' + key + '=[^&]*');
        var removeRegex = new RegExp('([\?&])' + key + '=[^&;]+[&;]?');

        if (value === undefined || value === null || value === '') { // Remove param if value is empty
            params = urlQueryString.replace(removeRegex, "$1");
            params = params.replace(/[&;]$/, "");

        } else if (urlQueryString.match(updateRegex) !== null) { // If param exists already, update it
            params = urlQueryString.replace(updateRegex, "$1" + newParam);

        } else if (urlQueryString == '') { // If there are no query strings
            params = '?' + newParam;
        } else { // Otherwise, add it to end of query string
            params = urlQueryString + '&' + newParam;
        }
    }

    // no parameter was set so we don't need the question mark
    params = params === '?' ? '' : params;

    return baseUrl + params;
}
*/
