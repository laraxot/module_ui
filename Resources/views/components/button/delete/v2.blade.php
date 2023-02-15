<a href="#" onclick="Livewire.emit('modal.open', 'modal.panel.destroy', {'model_type':'{{str_replace("\\","\\\\",get_class($panel->row))}}','model_id': '{{$panel->row->id}}'})" title="delete" data-toggle="tooltip"
    {{ $attributes->merge($attrs['button']) }}>
    <i {{ $attributes->merge($attrs['icon']) }}></i>
</a>
