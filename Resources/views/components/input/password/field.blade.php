@php
    //https://italia.github.io/bootstrap-italia/docs/form/input/#input-password

    //Theme::add($comp_ns.'/css/forms.scss');
    //Theme::add($comp_ns.'/css/form-password.scss');
    //Theme::add($comp_ns.'/js/password-strength-meter.js');

@endphp
<input type="password" {{ $attributes->merge($attrs) }} />
