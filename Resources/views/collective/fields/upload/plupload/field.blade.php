@php
Theme::add($comp_ns . '/js/plupload.full.min.js');
Theme::add($comp_ns . '/js/moxie.js');
Theme::add($comp_ns . '/js/plupload.dev.js');
Theme::add($comp_ns . '/js/plupload.js');

$field = transFields(get_defined_vars());
$src = Form::getValueAttribute($name);
if ($src == '') {
    $src = asset('/img/nophoto.jpg');
}
$field->attributes['id'] = 'file_src_src_' . $field->label;
@endphp

{{-- <div id="filelist_$field->label">
</div> --}}


{{ Form::hidden('path[]', '', ['id' => 'path_' . $field->label]) }}

<!--div id="container" -->
<button type="button" id="pickfiles_{{ $field->label }}" data-input="{{ $field->attributes['id'] }}"
    class="btn btn-danger text-white">
    loading...
</button>

<br />
<pre id="console_{{ $field->label }}"></pre>

<script>
    window.addEventListener('DOMContentLoaded', (event) => {
        createUploader({{ $field->label }});
    });
</script>
