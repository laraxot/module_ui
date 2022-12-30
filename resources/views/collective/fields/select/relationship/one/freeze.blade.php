@php
   $txt='---';
   $value=$field->value;
   if(is_object($value)){
        $value_panel=Panel::make()->get($value);
        $txt=$value_panel->optionLabel($value);
   }else{
       //dddx(get_defined_vars()); //4 debug
   }
@endphp
<span class="badge badge-secondary">
    {{ $txt }}
</span>

