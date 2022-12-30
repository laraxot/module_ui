@php
$qs = collect(request()->query())
    ->except(['q'])
    ->all();
if (!isset($form_class)) {
    $form_class = 'd-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search float-right';
}
@endphp
<form class="{{ $form_class }}" method="get">
    <div class="input-group">
        <input name="q" type="text" class="form-control {{-- bg-light border-0 --}}  small" placeholder="Search for..."
            aria-label="Search" aria-describedby="basic-addon2" value="{{ Request::input('q') }}">
        @foreach ($qs as $k => $v)
            @if (is_array($v))
                @php
                    $a = [$k => $v];
                @endphp
                @foreach (Arr::dot($a) as $k1 => $v1)
                    <input type="hidden" name="{{ dottedToBrackets($k1) }}" value="{{ $v1 }}">
                @endforeach
            @else
                <input type="hidden" name="{{ $k }}" value="{{ $v }}">
            @endif
        @endforeach
        <div class="input-group-append">
            <button class="btn btn-primary" type="submit">
                <i class="fas fa-search fa-sm"></i>
            </button>
        </div>
    </div>
</form>
