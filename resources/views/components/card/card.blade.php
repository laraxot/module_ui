<div class="card">
    @if(isset($top))
      {!! $top !!}
    @endif
    @if(isset($header))
    <div class="card-header">
    {{ $header ?? ''}}
    </div>
    @endif
  <div class="card-body">
    <h5 class="card-title">{{ $title ?? ''}}</h5>
    <h6 class="card-subtitle mb-2 text-muted">{{ $subtitle ?? ''}}</h6>
    <p class="card-text">{{ $txt ?? '' }}</p>
    {{--
    @foreach($links as $link)
    <a href="#" class="card-link">Card link</a>
    <a href="#" class="card-link">Another link</a>
    --}}
  </div>
  <div class="card-footer">
    {{ $footer ?? '' }}
  </div>
</div>