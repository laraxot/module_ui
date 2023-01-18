$(function() {
//jQuery(document).ready(function($){
//$(document).ready(function(){
	var modal_callback='';
	$('.modal').on('show.bs.modal', function (event)  {
		var button = $(event.relatedTarget); // Button that triggered the modal
		var title = button.data('title'); // Extract info from data-* attributes
		var modal = $(this);
		modal.find('.modal-title').text(title);
	});


	$('#myModalAjax').on('show.bs.modal', function (event)  {
		 /*$(this).find('.modal-dialog').css({width:'auto',
								   height:'auto',
								  'max-height':'100%'});
		*/
		var loading='<i class="fa fa-refresh fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>';
		var button = $(event.relatedTarget); // Button that triggered the modal
		var title = button.data('title'); // Extract info from data-* attributes
		var url = button.data('href');
		// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
		// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
		var modal = $(this);
		modal.data('reload',0);
		modal_callback = button.data('callback');
		//alert(modal.find('#myModalLabel').text());
		//modal.find('#myModalAjaxLabel').text(title);
		modal.find('.modal-title').text(title);
		modal.find('.modal-body').html(loading);
		//modal.find('.form-msg').html('');
		$.ajax({
			url:url
		}).done(function( data ) {
			console.log('35');
			console.log(data);
			console.log(data.html);
			ajaxLink(data.html,modal,'');
		}).fail(function(response){
			var err=response.responseJSON.message;
			modal.find('.form-msg').html(err);
		});
	});
	$('#myModalAjax').on('hidden.bs.modal', function (event)  {
		var modal = $(this);
		//alert(modal_callback);
		///*
		if(modal_callback!=undefined){
			eval(modal_callback);
		}
		//*/
		// modal.find('#myModalLabel').text('loading..');
		// modal.find('.form-msg').html('');
		modal.find('.modal-body').html('<i class="fa fa-refresh fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>');
		//alert('chiuso');
		if(modal.data('reload')){
			//alert('contenuto aggiornato percio ricarico');
			location.reload();
		}
	});

	function ajaxLink(data,modal,msg){
		var loading='<i class="fa fa-refresh fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>';
		modal.find('.modal-body').html(data);
		modal.find('.form-msg').html(msg);
		//modal.modal('handleUpdate');
		modal.find('a').click(function( e ) {
            var mylink=$(this);
            var actionurl=mylink.attr('href');
            if(actionurl==undefined){
                return ;
            }
            if(actionurl.charAt(0)=='#'){
                return ;
            }
			modal.find('.modal-body').html(loading);
		   	e.preventDefault();

		   	$.ajax({
				url: actionurl,
				type: 'get'
				//dataType: 'json',
				//data: querystring
			}).done(function( data ) {
				ajaxLink(data.html,modal,'');
			}).fail(function(response){
				var err=response.responseJSON.message;
				modal.find('.form-msg').html(err);
			});
		});

		modal.find('form').submit(function(e){
			e.preventDefault();
			modal.find('.form-msg').html(loading);
			var old_data=modal.find('.modal-body').html();
			modal.find('.modal-body').html(loading);
			var myform = $(this);
			var querystring = myform.serialize();
			var actionurl = e.currentTarget.action;
			$.ajax({
				url: actionurl,
				type: 'post',
				dataType: 'json',
				data: querystring
			}).done(function( data ) {
				var msg='<div class="alert alert-success"><strong>Success </strong>'+data.msg+'</div>';
				//modal.find('.form-msg').html(msg);
				//modal.find('.modal-body').html(data.html); // prima c'era old_data
				ajaxLink(data.html,modal,msg);
				modal.data('reload',1);
			}).fail(function(response){
                console.log(response);
                document.write(response.responseText);
				var err='';
				var errors=response.responseJSON.errors;
				for(i in errors){
					err=err+'<div class="alert alert-danger"><strong>Error! </strong>'+i+' '+errors[i]+'</div>';
				}
				modal.find('.form-msg').html(err);
			});

			//alert('preso !');
		});
	}

});
