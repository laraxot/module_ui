@php
	Theme::add('backend::includes/components/form/chunk_upload/js/csv.js');
@endphp
<style>
.btn-file {
	position: relative;
	overflow: hidden;
}
.btn-file input[type=file] {
	position: absolute;
	top: 0;
	right: 0;
	min-width: 100%;
	min-height: 100%;
	font-size: 100px;
	text-align: right;
	filter: alpha(opacity=0);
	opacity: 0;
	outline: none;
	background: white;
	cursor: inherit;
	display: block;
}
</style>

<div class="input-group">
	<span class="input-group-addon btn btn-default btn-file">
		<i class="fa fa-folder-open-o"></i>
		<input class="fileupload filestyle chunckcsv" type="file"  data-url="{{  url('admin/backend/uploadcsv') }}" data-name="{{ $name }}" data-input="false" accept=".csv"  data-dir='c:/download/csv' >Sfoglia
	</span>
	{{ Form::text($name, $value, array_merge(['class' => 'form-control'], $attributes)) }}
</div>
<div class="progress">
	<div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%">
		 <span id="current-progress"></span>
	</div>
</div>
<div id='buffer' style="display:none;"></div>


