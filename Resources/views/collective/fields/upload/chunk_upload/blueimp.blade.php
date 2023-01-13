@php
	Theme::add('/theme/bc/blueimp-file-upload/js/vendor/jquery.ui.widget.js');
	Theme::add('/theme/bc/blueimp-file-upload/js/jquery.iframe-transport.js');
	Theme::add('/theme/bc/blueimp-file-upload/js/jquery.fileupload.js');
	Theme::add('backend::includes/components/form/chunk_upload/js/blueimp.js');
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
		<input class="fileupload filestyle" type="file" name="file" data-url="{{ url('admin/backend/upload') }}" data-name="{{ $name }}" data-input="false">Sfoglia
    </span>
	{{ Form::text($name, $value, array_merge(['class' => 'form-control'], $attributes)) }}
</div>
<ul id="file-upload-list" class="list-unstyled">
</ul>


