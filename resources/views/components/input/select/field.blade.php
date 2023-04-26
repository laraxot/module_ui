@props(['name', 'options' => [], 'value' => null])

<select {{ $attributes->merge($attrs) }} wire:ignore>
    @if ($attributes['remove_first_empty_option'] !== 'true')
        <option value="">---</option>
    @endif
    @if (isset($options))
        @foreach ($options as $k => $v)
            @if (Arr::isAssoc($v))
                <option value="{{ $v['id'] }}" {!! $v['id'] == $value ? 'selected' : '' !!} {!! $v['disabled'] ? 'disabled' : '' !!}>
                    {{ $v['name'] }}
                </option>
            @else
                <option value="{{ $k }}" {!! $k == $value ? 'selected' : '' !!}>
                    {{ $v }}
                </option>
            @endif
        @endforeach
    @endif
</select>
