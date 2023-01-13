@component($input_component, get_defined_vars())
    @slot('label')
        <label>
            {{ $label }}
        </label>
    @endslot
    @slot('input')

        <input type="datetime-local" {{ $attributes->merge($attrs) }} step="15" />

        {{-- <div class="datetime_flatpickr input-group mb-3">
            <input type="datetime-local" {{ $attributes->merge($attrs) }}  />

            <div class="input-group-append">
                <a class="btn btn-outline-secondary" title="toggle" data-toggle>
                    <i class="far fa-calendar-alt"></i>
                </a>
            </div>
            <div class="input-group-append">
                <a class="btn btn-outline-secondary" title="clear" data-clear>
                    <i class="fas fa-times"></i>
                </a>
            </div>

        </div> --}}

    @endslot
@endcomponent
