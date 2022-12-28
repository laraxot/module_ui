@php
//Theme::add('backend::includes/components/form/chunk_upload/js/csv.js');
Theme::add($comp_ns . '/js/csv.js');
Theme::add($comp_ns . '/css/csv.css');
$field = transFields(get_defined_vars());
//dddx(get_defined_vars());
//dddx(url()->current());
$url = url()->current();

$field->data_url = url('admin/xot/it/image?_act=chunk_upload');
$field->data_dir = dirname(\Storage::disk('cache')->path('test.csv'));
@endphp
<div class="input-group">

    <span class="input-group-addon btn btn-default btn-file">
        <i class="fa fa-folder-open-o"></i>
        <input class="fileupload filestyle chunckcsv" type="file" data-url="{{ $field->data_url }}"
            data-name="{{ $name }}" data-input="false" accept=".csv" data-dir="{{ $field->data_dir }}">Sfoglia
    </span>
    {{ Form::text($name, $value, $field->attributes) }}
</div>
<div class="progress">
    <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="0"
        aria-valuemin="0" aria-valuemax="100" style="width:0%">
        <span id="current-progress"></span>
    </div>
</div>
<div id='buffer' style="display:none;"></div>
