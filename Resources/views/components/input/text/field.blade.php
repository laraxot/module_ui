@if (isset($icon))
    <div class="input-label-absolute input-label-absolute-right">
        <div class="label-absolute"><i class="fa fa-search"></i></div>
@endif
{{-- {{ dddx($attributes->merge($attrs)) }} --}}
<input type="text" {{ $attributes->merge($attrs) }} />
@if (isset($icon))
    </div>
@endif
