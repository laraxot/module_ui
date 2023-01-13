@php
    // https://github.com/samclarke/SCEditor
    // https://www.sceditor.com/

    Theme::add('https://cdn.jsdelivr.net/npm/sceditor@3/minified/themes/default.min.css');
    Theme::add('https://cdn.jsdelivr.net/npm/sceditor@3/minified/sceditor.min.js');
    Theme::add('https://cdn.jsdelivr.net/npm/sceditor@3/minified/formats/xhtml.min.js');

    $field = transFields(get_defined_vars());
    $field->attributes['style'] = 'height:300px;width:100%;';
    $field->attributes['id'] = $name;
@endphp


@component($blade_component, get_defined_vars())
    @slot('label')
        {{ Form::label($name, $field->label, ['class' => 'control-label']) }}
    @endslot
    @slot('input')
        {{ Form::textarea($name, $value, $field->attributes) }}
    @endslot
@endcomponent
{{-- {{ dddx(url('assets/sceditor')) }} --}}
{{-- {{ dddx(Storage::disk('public_html')->url('assets/sceditor/emoticons')) }} --}}

@push('scripts')
    <script>
        var textarea = document.getElementById('{{ $name }}');

        sceditor.create(textarea, {
            format: 'xhtml',
            style: 'https://cdn.jsdelivr.net/npm/sceditor@3/minified/themes/content/default.min.css',
            // Le immagini si trovano scaricando lo zip da https://www.sceditor.com/
            emoticonsRoot: '{{ Storage::disk('public_html')->url('assets/sceditor/') }}'
        });
    </script>
@endpush
