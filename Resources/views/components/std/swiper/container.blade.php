{{-- https://github.com/nolimits4web/Swiper/blob/master/demos/010-default.html --}}
<div class="swiper-container {{ $attrs['container_class'] }}">
    <div class="swiper-wrapper {{ $attrs['wrapper_class'] }}" style="{{ $attrs['wrapper_style'] }}">
        {{-- <div class="swiper-slide">Slide 1</div>
      <div class="swiper-slide">Slide 2</div>
      <div class="swiper-slide">Slide 3</div>
      <div class="swiper-slide">Slide 4</div>
      <div class="swiper-slide">Slide 5</div>
      <div class="swiper-slide">Slide 6</div>
      <div class="swiper-slide">Slide 7</div>
      <div class="swiper-slide">Slide 8</div>
      <div class="swiper-slide">Slide 9</div>
      <div class="swiper-slide">Slide 10</div> --}}
        {{ $slot }}
    </div>
</div>
