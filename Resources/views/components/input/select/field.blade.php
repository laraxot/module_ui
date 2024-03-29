@props(['name', 'options' => [], 'value' => null, 'defaultValue' => '---', 'wireignore' => 'true'])


<select {{ $attributes->merge($attrs) }} @if ($wireignore == true) wire:ignore @endif>
    @if ($attributes['remove_first_empty_option'] !== 'true')
        <option value="">{{ $defaultValue }}</option>
    @endif
    @if (isset($options))
        @foreach ($options as $k => $v)
            @if (is_array($v))
                @if (Arr::isAssoc($v))
                    <option value="{{ $v['id'] }}" {!! $v['id'] == $value ? 'selected' : '' !!} {!! $v['disabled'] ? 'disabled' : '' !!}>
                        {{ $v['name'] }}
                    </option>
                @endif
            @endif
            @if (is_string($v))
                <option value="{{ $k }}" {!! $k == $value ? 'selected' : '' !!}>
                    {{ $v }}
                </option>
            @endif
        @endforeach
    @endif
</select>
