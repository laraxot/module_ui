@props([
  'title'
])
<div class="cmp-heading @if(isset($heading_p0)) p-0 @else pb-3 pb-lg-4 @endif">
    @if(isset($iconTitle))
        <div class="categoryicon-top d-flex">
            <svg class="icon icon-success {{$iconClass}}" aria-hidden="true">
                <use href="../assets/bootstrap-italia/dist/svg/sprites.svg#{{$iconTitle}}"></use>
            </svg>
            @if(isset($h2))
                <h2 class="title-xxxlarge mb-0 ml-10 {{--title-class--}}">{{$title}}</h2>
            @else
                <h1 class="title-xxxlarge {{--title-class--}}">{{$title}}</h1>
            @endif
        </div>
    @else
        @if(isset($h2))
            <h2 class="title-xxxlarge {{--title-class--}}">{{$title}}</h2>
        @else
            <h1 class="title-xxxlarge {{--title-class--}}">{{$title}}</h1>
        @endif
    @endif



@if(isset($label_tag_up))
  <div class="d-flex flex-wrap cmp-heading__tag">
    {{-- <x-partials.tag.tag>
        <x-slot name="class"></x-slot>
        <x-slot name="label_tag"></x-slot>
        <x-slot name="label_tag_up"></x-slot>
    </x-partials.tag.tag> --}}
    <x-link type="tag">
    </x-link>
    {{-- {{>partials/cmp-tag/cmp-tag}} --}}
  </div>
@endif

@if(isset($subTitle))
  <p class="subtitle-small @if(isset($pClass)) {{ $pClass }} @endif">{{{$subTitle}}}</p>
@endif




  @if(isset($label_tag))
  <div class="d-flex flex-wrap gap-2 cmp-heading__tag">
    {{-- <x-partials.tag.tag>
        <x-slot name="class"></x-slot>
        <x-slot name="label_tag"></x-slot>
        <x-slot name="label_tag_up"></x-slot>
    </x-partials.tag.tag> --}}
    <x-link type="tag">
    </x-link>
    {{-- {{>partials/cmp-tag/cmp-tag}} --}}
  </div>
  @endif

  @if(isset($descriptionAfterTag))
  <p class="text-paragraph">
    {{$descriptionAfterTag}}
  </p>
  @endif


@if(isset($description))
  <p class="subtitle-small {{$desClass}}">{{$description}}</p>
@endif

@if(isset($button))
  {{-- <x-partials.button.button>
    <x-slot class="fw-bold"></x-slot>
  </x-partials.button.button> --}}

    <x-button type="advanced">
      <x-slot class="fw-bold"></x-slot>
    </x-button>
    {{-- {{>partials/button/button class="fw-bold"}} --}}
  @endif


@if(isset($double_button))
  <div class="d-lg-flex gap-30 mb-2">
    {{-- <x-partials.button.button>
      <x-slot name="class">fw-bold btn-primary mr-lg-30</x-slot>
    </x-partials.button.button> --}}

    <x-button type="advanced">
      <x-slot name="class">fw-bold btn-primary mr-lg-30</x-slot>
    </x-button>




    {{-- <x-partials.button.button>
      <x-slot name="class">fw-bold btn-outline-primary t-primary</x-slot>
      <x-slot name="label">second-label</x-slot>
      <x-slot name="aria_label">second-ariaLabel</x-slot>
    </x-partials.button.button> --}}

    <x-button type="advanced">
      <x-slot name="class">fw-bold btn-outline-primary t-primary</x-slot>
      <x-slot name="label">second-label</x-slot>
      <x-slot name="aria_label">second-ariaLabel</x-slot>
    </x-button>

  </div>
  @endif
<<<<<<< HEAD
</div>
=======
</div>
>>>>>>> 40ca9f0f (up)
