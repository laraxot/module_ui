@foreach ($value as $k=>$v)
    <pre>[{{ $k }}]:{{ print_r($v,true) }}</pre>
@endforeach
