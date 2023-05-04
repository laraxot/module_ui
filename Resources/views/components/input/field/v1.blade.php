@props([])

<div {{ $div_attrs }}>
    <x-input.label :name="$field->name" :id="$field->name" />
    <x-input :name="$field->name" :type="$field->type" :value="$value" :class="$field->getInputClass()" :options="$field->options"
        :attributes="$field->attributes" />
    @error($field->name)
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

</div>
