$(function() {

$('.chunckcsv').change(function(event) {

	var $url=$(this).data('url');
	var $dir=$(this).data('dir');
	var $input_name=$(this).data('name');
	var $tmppath = URL.createObjectURL(event.target.files[0]);
	var $name= event.target.files[0].name;
	var $chunksize=50000;
	$('#buffer').load($tmppath,function($data) {
  		var $curr=0;
  		console.log('length :'+$data.length);
  		sendChunk($name,$data,$curr);
	});
	function sendChunk($name,$data,$curr){
		var $perc=$curr*100/$data.length;
		$perc=$perc.toFixed(2);
		if($perc>100){
			$perc=100;
		}
		console.log($perc);
		$('.progress-bar')
				.css('width', $perc+'%')
				.attr('aria-valuenow', $perc)
				.text($perc + "% Complete");  
		var $chunk=$data.slice($curr,$curr+$chunksize);
		var $token=$( "input[name='_token']" ).val();
		var $data_post={ chunk: $chunk, seek: $curr, size: $data.length, name : $name, dir : $dir ,_token :$token};
		if($curr<$data.length){
			$.ajax({
				method: "POST",
				url: $url,
				data: $data_post,
				dataType: "json",
				headers: {
                	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            	}
			}).done(function(data, textStatus, jqXHR) {
				console.log(data);
  				sendChunk($name,$data,$curr+$chunksize);
			}).fail(function(jqXHR, textStatus, errorThrown) {
				console.log(jqXHR);
				console.log(textStatus);
				$('#buffer').show('fast').html(jqXHR.responseText);
    			alert( "error" );
  			}).always(function(jqXHR, textStatus, errorThrown) {
    			// Hide spinner image
			});

		}else{
			$('input[name="'+$input_name+'"]').val($dir+'/'+$name);
		}


	}

});


})