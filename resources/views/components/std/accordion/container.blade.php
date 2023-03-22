<div {{ $attributes->merge($attrs) }} id="accordionExample">
    <x-std tpl="accordion.item">
        <x-slot name="id">{{ $id }}</x-slot>
        <x-slot name="header">
            {{ $header }}
        </x-slot>

        <x-slot name="body">
            {{ $body }}
        </x-slot>
    </x-std>
</div>
