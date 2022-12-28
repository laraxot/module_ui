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

<fieldset class="form-group container-fluid border p-2" {{-- $disabled --}}>
    <legend class="col-form-label col-sm-2 pt-0 w-auto">
        <h4>{{ $name }}</h4>
    </legend>
    <div class="row">
        @foreach ($fields as $k => $field)
            {!! Theme::inputHtml(['row' => $model, 'field' => $field]) !!}
        @endforeach
    </div>
</fieldset>
