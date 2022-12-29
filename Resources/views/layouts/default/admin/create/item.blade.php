@php
if (!is_object($row)) {
    return '';
}
$fields = $_panel->getFields(['act' => 'create']);
@endphp
{!! Form::bsOpenPanel($_panel, 'store') !!}
<div class="row">
    @foreach ($fields as $field)
        {!! Theme::inputHtml(['row' => $row, 'field' => $field]) !!}
    @endforeach
</div>
{{ Form::bsSubmit('Save') }}
{!! Form::close() !!}
