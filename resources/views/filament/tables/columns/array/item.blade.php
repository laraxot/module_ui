@php
    /*
    try{
        $val=@unserialize($value);
    }catch(\TypeError $e){
        $val=$value;
    }
    $value=$val;
    */
@endphp

<li><b>{{ $key }}</b>:
    @if(is_iterable($value))
        <ul>
            @foreach($value as $k=>$v)
                @include('ui::filament.tables.columns.array.item',['key'=>$k,'value'=>$v])
            @endforeach
        </ul>
    @else
        {{ $value }}
    @endif
</li>