@foreach (explode(',', (string) $field->value) as $item)
    <div class="p-1 mb-1" style="background-color:{{ $item }}">&nbsp;</div>
@endforeach
