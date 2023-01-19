@php
//dddx($last_item)
//Form::bsOpen($last_item,'my_rating.index_edit')
//echo '['.Form::model($last_item,['url'=>'aaaa']).']';
//echo url()->current();
@endphp
{{-- {!! Form::bsOpen($last_item,'index_edit','index_edit') !!} --}}
{{ Form::model($last_item, ['url' => url()->current()]) }}
{{ Form::bsPivotFields($types) }}
{{ Form::bsSubmit('Salva') }}
