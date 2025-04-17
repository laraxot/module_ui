<form {{ $attributes->merge($form_attrs) }}>
    <div class="input-group">
        {{ Form::select('sort[by]', $options1, $sort_by, $input_attrs) }}
        {{ Form::select('sort[order]', $options, $sort_order, $input_attrs) }}
        @foreach ($qs as $k => $v)
            @if (is_array($v))
                @php
                    $a = [$k => $v];
                @endphp
                @foreach (Arr::dot($a) as $k1 => $v1)
                    <input type="hidden" name="{{ dottedToBrackets($k1) }}" value="{{ $v1 }}">
                @endforeach
            @else
                <input type="hidden" name="{{ $k }}" value="{{ $v }}">
            @endif
        @endforeach
        <div class="input-group-append">
            <button class="btn btn-primary" type="submit">
                <i class="fas fa-sort fa-sm"></i>
            </button>
        </div>
    </div>
</form>
