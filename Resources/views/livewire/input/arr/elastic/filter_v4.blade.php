<div>

    <div class="row">
        <div class="form-floating mb-2 col-sm-10">
            <input type="hidden" name="filter[0][criteria]" value="query_string_query">
            <input name="filter[0][q]" value="{{ $normal_search_data }}" id="TextInputRicerca" type="text"
                class="form-control shadow-lg border-soft-grape" placeholder="Ricerca nella trascrizione">
            <label for="TextInputRiceca">
                <i class="uil uil-search">
                </i> Ricerca nella trascrizione
            </label>
        </div>
        <div class="col-sm-2">
            <button type="submit" class="btn btn-primary col-12">Cerca</button>
        </div>
    </div>

    <div class="d-inline-flex mb-4">
    <h5 class="bg-pale-grape text-grape py-2 px-2 rounded">{{ $label ?? 'Criteri di Ricerca' }} <a href="#" wire:click="addArr()"
            class="btn btn-circle btn-primary btn-sm"><i class="uil uil-plus"></i></a>
    </h5>
</div>

    @foreach ($form_data[$name] ?? [] as $k => $v)
        @php
            //es. filter bool
            $input_name = $name . '[' . $k . ']';
            $wire_name = 'form_data.' . $name . '.' . $k;
        @endphp

        <div class="row">
            <div class="form-select-wrapper mb-4 col-10">
                <div class="input-group">
                    <select class="form-select" name="{{ $input_name }}[criteria]"
                        wire:model.lazy="{{ $wire_name }}.criteria">
                        <option value="query_string_query" selected>Query diretta:</option>
                        <option value="must">Deve contenere:</option>
                        <option value="mustNot">Non deve contenere:</option>
                        <option value="should">Potrebbe conterere (or):</option>
                        <option value="regexp">Inizia con:</option>
                    </select>
                </div>
            </div>
            <div class="input-group-append col-2 my-1">
                <a href="#" wire:click="subArr({{ $k }})" class="btn btn-circle btn-primary btn-sm">
                    <i class="uil uil-minus"></i>
                </a>
                <a href="#" onclick="addTilde('{{ $input_name }}[q]')"
                    class="btn btn-circle btn-primary btn-sm">
                    <i>~</i>
                </a>
            </div>
        </div>
        <div class="row">
            <div class=" mb-4">
                <input type="text" placeholder="Ricerca nella trascrizione" class="form-control"
                    name="{{ $input_name }}[q]" wire:model.lazy="{{ $wire_name }}.q">

                @if (isset($form_data[$name][$k]['criteria']) && $form_data[$name][$k]['criteria'] != 'query_string_query')
                    <div class="input-group-text my-2">
                        <input class="form-check-input" type="checkbox" name="{{ $input_name }}[fuzzy]"
                            wire:model.lazy="{{ $wire_name }}.fuzzy"
                            aria-label="Checkbox for following text input">&nbsp;Parola Simile
                    </div>
                @endif
            </div>
        </div>
    @endforeach
    {{-- dddx(count($form_data['filter'])) --}}
    @if (isset($form_data['filter']) && count($form_data['filter']) > 0)
        <div class="col-12 mb-4">
            <button type="submit" class="btn btn-primary col-12">Cerca</button>
        </div>
    @endif
    @push('scripts')
        <script>
            function addTilde(element) {
                const el = $('[name="' + element + '"]').not('#search_search')
                $(el).val($(el).val() + '~')
            }
        </script>
    @endpush
</div>
