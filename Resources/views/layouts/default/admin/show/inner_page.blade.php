@php
	if(!isset($show_type) && is_object($row)){
		$show_type=snake_case($row->post_type);
	}
	if(!isset($bg) && isset($show_type)){
		$bg='pub_theme::images/bg/'.$show_type.'.jpg';
	}

@endphp
<div class="inner-page-hero bg-image" data-image-src="{{ Theme::img_src($bg) }}">
    <div class="container"> </div>
        <!-- end:Container -->
</div>


