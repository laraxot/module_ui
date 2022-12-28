@php
    $src = $field->value;
    
    if (Str::startsWith($src, 'chart')) {
        $src = asset($src);
    }
    if (is_null($src)) {
        $src = Theme::asset('theme::views/skeleton/images/nophoto.png');
    }
@endphp
<img src="{{ $src }}" width="100" height="100" />
