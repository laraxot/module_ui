<div>
  
    @php
    /*
    dd([
        'getstate'=>$getState(),
        '$getRecord()'=>$getRecord(),
        'get_defined_vars()'=>get_defined_vars(),
    ]);
    */
    @endphp
    <ul>
    @foreach($getState() as $key=>$value)
        @include('ui::filament.tables.columns.array.item',['key'=>$key,'value'=>$value])
    @endforeach
    </ul>
</div>