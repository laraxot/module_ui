@php
    $tags_grouped=$field->value->groupBy('type');
@endphp
@foreach($tags_grouped as $group => $tags)
<fieldset class="border p-2">
    <legend  class="w-auto">{{ $group }}</legend>
    @foreach($tags as $tag)
        <span class="badge bg-success">{{ $tag->name }}</span>
    @endforeach
</fieldset>
@endforeach