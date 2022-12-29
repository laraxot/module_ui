@php
if (!is_object($row)) {
    return '';
}
$fields = $_panel->getFields(['act' => 'edit']);
//dddx(get_defined_vars());
//dddx($_panel);
@endphp
{!! Form::bsOpenPanel($_panel, 'update') !!}
<div class="row">
    @foreach ($fields as $field)
        {!! Theme::inputHtml(['row' => $row, 'field' => $field]) !!}
    @endforeach
</div>

{{ Form::bsSubmit('Modifica') }}
{!! Form::close() !!}
