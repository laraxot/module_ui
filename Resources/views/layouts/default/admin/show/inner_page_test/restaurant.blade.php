@php
    $restaurant_curr=collect($params)->where('type','restaurant')->last();
    $cuisineCats = $restaurant_curr->cuisineCats;

@endphp
<section class="inner-page-hero bg-image" data-image-src="{{ Theme::asset('theme/pub/images/restaurant-bg.jpg') }}">
    <div class="profile">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12  col-md-4 col-lg-4 profile-img">
                    <div class="image-wrap">
                        <figure>
                            {!! $restaurant_curr->image_html(['width'=>240,'height'=>140]) !!}
                        </figure>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 profile-desc"
                     style="background-color: black;opacity: 0.6;filter: alpha(opacity=50);">
                    <div class="pull-left right-text white-txt">
                        <h6><a href="{{ $restaurant_curr->url }}">{{ $restaurant_curr->title }}</a></h6>
                        <p>{{ $restaurant_curr->index_edit_url }}</p>
                        {{--  <a class="btn btn-small btn-green">Open</a> --}}
                        <p>{{ $restaurant_curr->subtitle }} </p>
                        <p>{{ $restaurant_curr->txt }}</p>

                        <ul class="nav nav-inline">
                            {{--
                            <li class="nav-item"> <a class="nav-link active" href="#"><i class="fa fa-check"></i> Min $ 10,00</a> </li>
                            <li class="nav-item"> <a class="nav-link" href="#"><i class="fa fa-motorcycle"></i> 30 min</a> </li>
                            <li class="nav-item ratings">
                                <a class="nav-link" href="#">
                                    <span>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                    </span>
                                </a>
                            </li>
                            --}}
                        </ul>
                    </div>
                    <div class="font-white">
                        <i class="fa fa-cutlery" aria-hidden="true"></i>
                        @if($cuisineCats != null)
                            @foreach($cuisineCats as $cuisineCat)
                                <span itemprop="servesCuisine" class="font-white">{{ $cuisineCat->title }}</span>,
                            @endforeach
                        @endif
                        <br/>
                        @include('pub_theme::layouts.partials.item.address',['linked'=>$restaurant_curr])
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>