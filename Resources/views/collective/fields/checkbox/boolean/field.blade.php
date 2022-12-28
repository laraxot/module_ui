@php
$field = transFields(get_defined_vars());
//provo a cambiare un po il layout per visualizzare meglio il checkbox
//utilizzo un nuovo blade_component fatto a doc per i campi boolean
//(ancora in test, nel caso cancellare il nuovo componente)
//dddx($field->attributes);
@endphp
@component($blade_component, get_defined_vars())
    @slot('label')
        {{ Form::label($name, $field->label, ['class' => 'control-label form-label']) }}
    @endslot
    @slot('input')
        {{-- Form::bsHidden($name,0) --}} {{-- se non selezionato restituisce 0 al posto di null --}}
        <input type="hidden" name="{{ $name }}" value="0">
        {{ Form::checkbox($name, 1, $value, $field->attributes) }}
    @endslot
@endcomponent
