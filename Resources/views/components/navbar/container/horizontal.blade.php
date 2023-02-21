{{-- <ul class="nav nav-tabs align-items-end card-header-tabs w-100"> --}}
<div class="card-header">
    <ul {{ $attributes->merge($attrs) }}>
        {{ $slot }}
    </ul>
</div>
