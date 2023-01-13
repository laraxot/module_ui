@php
/*
    visualizza un calendario con evidenziati i giorni elencati
    da utilizzare nel caso si abbia, nel db, un campo stringa che elenca una serie di date
    esempio: 18/8/2004,19/6/2004,19/8/2004,25/8/2004,26/8/2004,28/7/2004,29/7/2004,30/7/2004

    (object)
[

        'type' => 'DateList',
        'name' => 'listadata',
        'comment' => null,
        'col_size' => 6,
    ],
*/

$field = transFields(get_defined_vars());
//dddx([get_defined_vars(),$field]);
$date_list = $_panel->getRow()->{$name};
//dddx($lista_data);
@endphp
{{-- <livewire:calendar.stringlist  :date_list="$date_list" /> --}}




@component($blade_component, get_defined_vars())
    @slot('label')
        {{ Form::label($name, $field->label, ['class' => 'control-label form-label']) }}
    @endslot
    @slot('input')
        @livewire('calendar.stringlist',['date_list'=>$date_list, 'input_name' => $name])
    @endslot
@endcomponent
