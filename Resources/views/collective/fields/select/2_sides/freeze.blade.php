@foreach ($rows as $k => $v)

    @if (
        !empty(Panel::make()->get($v)->optionLabel($v)
        ))
        <x-badge>{{ Panel::make()->get($v)->optionLabel($v) }}</x-badge>
    @else
        <x-badge>{{ $v->{$related_fields[1]->name} }}</x-badge>
    @endif
