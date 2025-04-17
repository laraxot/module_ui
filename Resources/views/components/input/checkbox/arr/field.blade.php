@props([
    'options'=>[],
    'arr'=>[],
    'value'=>null,
    ])
@php
    if(!Arr::isAssoc($options)){
        $options=array_combine($options,$options);
    }
    if(is_string($value)){
        $value=str_replace('&quot;','"',$value);
    }
    if(isJson($value)){
        $value=json_decode($value);
    }
   
@endphp
<div class="form-check">
    @foreach ($options as $key => $option)
        @php
            $attrs['wire:model.lazy'] = 'form_data.' . $name . '.' . $loop->index;
        @endphp
       
        <input type="checkbox" {{ $attributes->merge($attrs) }} value="{{ $key }}">
        <label for="{{ $attrs['name'] }}"> {{ $option }}</label><br>
    @endforeach
</div>
