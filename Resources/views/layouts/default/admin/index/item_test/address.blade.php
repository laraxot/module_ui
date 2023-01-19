<div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress" class="font-white">
    <i class="fa fa-map-marker" aria-hidden="true"></i>
    @if(isset($linked->route))
        <span itemprop="streetAddress">{{ $linked->route }},{{ $linked->street_number }}</span>
        -
    @endif
    @if(isset($linked->postal_code))
        <span itemprop="postalCode">{{ $linked->postal_code }}</span>
    @endif
    @if(isset($linked->locality))
        <span itemprop="addressLocality">{{ $linked->locality }}</span>,
    @endif
    @if(isset($linked->administrative_area_level2_short))
        (<span itemprop="addressRegion">{{ $linked->administrative_area_level_2_short }}</span>)
    @endif
    @if(isset($linkd->country_short))
        <meta itemprop="addressCountry" content="{{ $linked->country_short}}"/>
    @endif
</div>