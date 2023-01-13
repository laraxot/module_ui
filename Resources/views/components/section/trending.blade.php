@props([
    'title',
    'subtitle',
])
<!-- Our picks section-->
<section class="py-6">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-8">
                <p class="subtitle text-primary">{{ $title }}</p>
                <h2>{{ $subtitle }}</h2>
            </div>
            <div class="col-md-4 d-md-flex align-items-center justify-content-end">
                <a class="text-muted text-sm" href="category.html">
                    See all cities<i class="fas fa-angle-double-right ms-2"></i>
                </a>
            </div>
        </div>

        <div class="row">
            {{--
            @foreach ($rows as $row)
                <x-trending.grid.item :row="$row"></x-trending.grid.item>
            @endforeach
            --}}
        </div>


        <div class="row">
            <!--+grid(val)-->
            <!--+grid(val)-->
        </div>
        <div class="row">
            <!--+grid(val)-->
            <!--+grid(val)-->
            <!--+grid(val)-->
        </div>
    </div>
</section>
