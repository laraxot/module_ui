@props([
    'title',
    'rows'
])
<div class="col">
    <h6>{{ $title }}</h6>
    @foreach ($rows as $row)
        <p style="mb-5">
            <a href="{{ $row->url }}">{{ $row->txt }}</a> ({{ $row->n }} / {{ $rows->sum('n') }})
            <x-progress.bar value="{{ round(($row->n * 100) / $rows->sum('n'), 2) }}" />
        </p>
    @endforeach
</div>
