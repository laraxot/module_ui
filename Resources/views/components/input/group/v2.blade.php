@props([
    'name' => null,
    'label' => null,
])

<div {{ $div_attrs->merge(['class'=>'form-group row']) }}>
    <x-input.label {{ $label_attrs->merge(['class'=>'col-md-4 col-form-label text-md-right']) }} />
    <div class="col-md-6">
        <x-input {{ $input_attrs }} :options="$options" />
        @error($name)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
