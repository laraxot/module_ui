@foreach($value->chunk(5) as $chunk)
    <br/>
    @foreach($chunk as $v)
    <span class="badge text-uppercase bg-soft-primary text-primary rounded-pill">
        {{ Panel::make()->get($v)->optionLabel($v) }}
    </span>
    @endforeach 
@endforeach