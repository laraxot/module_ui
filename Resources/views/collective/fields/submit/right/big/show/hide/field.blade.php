@php
Theme::add($comp_ns . '/js/script.js');
@endphp

<div class="form-group">
    {{ Form::submit($name, array_merge(['id' => 'submitButton', 'class' => 'btn btn-info', 'style' => 'display:block;', 'disabled'])) }}
</div>
