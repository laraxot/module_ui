@php
if (isset($options['field'])) {
    //$options = $options['field']->options;
}
extract($attributes);
$field = transFields(get_defined_vars());
$value = Form::getValueAttribute($name);
@endphp

@component($blade_component, get_defined_vars())
    @slot('label')
        {{ Form::label($name, $field->label, ['class' => 'control-label']) }}
    @endslot
    @slot('input')
        <livewire:input.string-list.color :name="$name" :value="$value" />

        {{-- <input type="text" name="{{ $name }}" />
        <div class="list_color">
            <input type="color">
        </div> --}}
        {{-- Form::select($name, $options, $value, $field->attributes) --}}
    @endslot
@endcomponent

@push('scripts')
@endpush
