<div class="col-md-6 col-lg-4">
    <div class="card border-0 transform-on-hover">
        {{-- <a class="lightbox" href="{{ $row->image_src }}">
    		<img src="{{ $row->imageResizeSrc(['width'=>300,'height'=>150]) }}" alt="Card Image" class="card-img-top">
    	</a> --}}
        <div class="card-body">
            <h6><a href="{{ $row->url }}">{{ $row->title }}</a></h6>
            <p class="text-muted card-text">{{ $row->subtitle }}</p>
        </div>
        <div>
            @php
                //dddx($row->tabs);
                //dddx($view_default.'.tabs');
            @endphp
            @if (is_array($row->tabs))
                @includeFirst([$view_default.'.item.tabs'],['tabs'=>$row->tabs] )
            @endif
        </div>
    </div>
</div>
