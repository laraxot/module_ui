{{-- <section {{ $attributes->merge($attrs) }}> --}}
{{-- <section class="{{ $class }}" style="{{ $style }}"> --}}
<section {{ $wrapper->attributes->class([]) }} style="{{ $style }}">
    <div class="container py-6 py-lg-7 text-white overlay-content text-center">
        <div class="row">
            <div class="col-xl-10 mx-auto">
                <h1 class="display-3 fw-bold text-shadow">{{ $title }}</h1>
                <p class="text-lg text-shadow">{{ $subtitle }}</p>
            </div>
        </div>
    </div>
</section>
