@php
if (!is_object($row)) {
    return '';
}
$fields = $_panel->getFields('create');
@endphp
{!! Form::bsOpenPanel($_panel, 'store') !!}
<div class="row">
    @foreach ($fields as $field)
        {!! Theme::inputHtml($field,$row) !!}
    @endforeach
</div>
{{ Form::bsSubmit('Save') }}
{!! Form::close() !!}
