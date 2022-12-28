@php
$fields = $attributes['fields'];
$model = Form::getModel();
$disabled = isset($attributes['disabled']) ? 'disabled' : '';
$fields = collect($fields)
    ->filter(function ($item) {
        if (!isset($item->except)) {
            $item->except = [];
        }
        return //!in_array($item->type,['Password']) &&
            !in_array('edit', $item->except); //controllare azione route
            //&& !in_array($item->name,$excepts)
    })
    ->all();
if ($disabled) {
    $fields = collect($fields)
        ->map(function ($item) {
            if (!isset($item->attributes)) {
                $item->attributes = [];
            }
            $item->attributes = array_merge($item->attributes, ['readonly' => 'readonly']);
            return $item;
        })
        ->all();
}

@endphp
<p>
    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample"
        aria-expanded="false" aria-controls="collapseExample">
        <h4>{{ $name }}</h4>
    </button>
</p>
<div class="collapse collapsed" id="collapseExample">
    {{-- <div class="card card-body"> --}}

    @foreach ($fields as $k => $field)
        {!! Theme::inputHtml(['row' => $model, 'field' => $field]) !!}
    @endforeach
    {{-- </div> --}}
</div>
