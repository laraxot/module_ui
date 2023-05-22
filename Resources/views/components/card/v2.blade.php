@props(['title', 'tools' => null, 'footer' => null])
<div {{ $attributes->merge(['class' => 'card']) }}>
    @if ($title || $tools)
        <div class="card-header border-0 p-3 d-flex justify-content-between align-items-center">
            @if ($title)
                <h3 class="card-title p-0 m-0">
                    {!! $title !!}
                </h3>
            @endif
            @if ($tools)
                <div class="card-tools p-0 m-0">
                    {!! $tools !!}
                </div>
            @endif
        </div>
    @endif
    @if ($txt)
        <div class="card-body p-3 h-auto">
            {!! $txt !!}
        </div>
    @endif
    @if ($footer)
        <div class="card-footer bg-transparent p-2">
            {!! $footer !!}
        </div>
    @endif
</div>
