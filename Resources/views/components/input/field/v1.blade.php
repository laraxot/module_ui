@props([])

<div {{ $div_attrs }}>

    <x-input.label :name="$field->name" :id="$field->name" />

    {{--  
    <x-input.label {{ $label_attrs }} />
    --}}
    <x-input :name="$field->name" :type="$field->type" :value="$value" :class="$field->getInputClass()" :options="$field->options"
        :attributes="$field->attributes" />

    {{--  
    <x-input {{ $input_attrs }} :options="$options" value="{{ old($name) }}" />
    --}}
    @error($field->name)
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

</div>
