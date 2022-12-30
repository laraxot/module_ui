<div>
    <div class="w-100 mb-3">
        <h3 class="float-left">{{ $label ?? $name }}</h3>
        <button type="button" class="btn btn-primary float-right" wire:click="addArr()"> Add ( + ) </button>
    </div>

    {{-- laxy vuol dire che fa l'aggiornamento non ad ogni lettera che scrivi, ma ogni tot temp, per non sovraccaricare di richieste il server
    e anche per evitare troppi refresh in frontend (vedi doc. Livewire) --}}
    @foreach ($form_data[$name] ?? [] as $k => $v)
        <div class="input-group" :wire:key="'group-'.$model_id">
            <div class="input-group-text">
                <input type="checkbox" wire:model.lazy="form_data.fuzzy_{{ $name }}.{{ $k }}"
                    name="fuzzy_{{ $name }}[]" class="form-check-input mt-0" aria-label="Fuzzy" />&nbsp;Simile
            </div>
            <input type="text" wire:model.lazy="form_data.{{ $name }}.{{ $k }}"
                value="{{ $v }}" name="{{ $name }}[]" class="form-control" />
            <button type="button" class="btn btn-danger input-group-text" wire:click="subArr({{ $k }})"
                :wire:key="'sub-arr-'.$model_id"> -
            </button>
        </div>
    @endforeach
</div>

{{-- per l'errore dei checkbox mancanti probabilmente manca wire:ignore. vedi StackOverflow --}}
