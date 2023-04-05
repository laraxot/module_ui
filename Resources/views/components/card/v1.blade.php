@props([
    'title',
    'tools'=>null,
    'footer'=>null,
])
<div {{ $attributes->merge(['class'=>'card']) }} >
    <div class="card-header border-0">
        <h3 class="card-title">
           {!! $title !!}
        </h3>
        <div class="card-tools">
            {!! $tools !!}
        </div>
    </div>
    <div class="card-body">
        {!! $txt !!}
    </div>
    <div class="card-footer bg-transparent">
        {!! $footer !!}
    </div>
</div>