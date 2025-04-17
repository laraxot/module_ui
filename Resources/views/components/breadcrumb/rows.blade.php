<div class="cmp-breadcrumbs {{ $class ?? '' }}" role="navigation">
    <nav class="breadcrumb-container">
        <ol class="breadcrumb p-0" data-element="breadcrumb">
            @foreach ($rows as $item)
                <li class="breadcrumb-item
					@if ($loop->last) active @endif
				">
                    <a href="#">{{ $item->name }}</a>
                    @if (!$loop->last)
                        <span class="separator">/</span>
                    @endif
                </li>
            @endforeach
        </ol>
    </nav>
</div>
