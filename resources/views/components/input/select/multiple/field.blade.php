<select {{ $attributes->merge($attrs) }}>
    @foreach ($options as $key => $value)
        <option value="{{ $key }}">{{ $value }} </option>
    @endforeach
</select>
