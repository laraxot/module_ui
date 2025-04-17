<div class="form-check" wire:ignore>
    @foreach ($options as $key => $option)
        <input type="checkbox" name="{{ $name }}[]" value="{{ $key }}"
            wire:model="form_data.{{ $name }}.{{ $key }}">
        <label for="{{ $attrs['name'] }}"> {{ $option }}</label><br>
    @endforeach
</div>
