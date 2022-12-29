@props(['name', 'options' => [], 'value' => null])

<select {{ $attributes->merge($attrs) }} wire:ignore>
    @if ($attributes['remove_first_empty_option'] !== 'true')
        <option value="">---</option>
    @endif
    @if (isset($options))
        @foreach ($options as $k => $v)
            <option value="{{ $k }}" {!! $k == $value ? 'selected' : '' !!}>
                {{ $v }}
            </option>
        @endforeach
    @endif
</select>
