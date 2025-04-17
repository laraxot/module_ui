<div {{ $attributes->merge($attrs) }}>
    <h2 class="accordion-header" id="heading{{ $id }}">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapse{{ $id }}" aria-expanded="true" aria-controls="collapse{{ $id }}">
            {{ $header }}
        </button>
    </h2>
    <div id="collapse{{ $id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $id }}"
        data-bs-parent="#accordionExample">
        <div class="accordion-body">
            {{ $body }}
        </div>
    </div>
</div>
