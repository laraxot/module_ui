@props([
  'icon'=>false,
  'wrapper',
])
<div class="cmp-hero">
    <section class="it-hero-wrapper bg-white align-items-start">
      <div {{ $wrapper->attributes->class(['it-hero-text-wrapper']) }}>
        @if($icon)
          <div class="categoryicon-top d-flex">
            <svg class="icon icon-success {{$iconClass}}" aria-hidden="true">
              <use href="../assets/bootstrap-italia/dist/svg/sprites.svg#{{$icon}}"></use>
            </svg>
            <h1 class="text-black hero-title" data-element="page-name">{{$title}}</h1>
          </div>
        @else
          <h1 class="text-black hero-title" data-element="page-name">{{{$title}}}</h1>
        @endif

        @if(isset($txt))
          <div class="hero-text">
            <p>{{$txt}}</p>
          </div>
        @endif
      </div>
    </section>
  </div>