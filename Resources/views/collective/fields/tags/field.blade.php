@php
/* esempio di utilizzo nel pannello, funzione fields
    (object)
[
        'type' => 'Tags',
        'name' => 'tags',
        'col_size' => 12,
        'options' => ['domains'],
    ],
*/
$opts = $options['field']->options;
//dddx([$opts, get_defined_vars()]);
$row = $_panel->row;
//-- per popolare velocemente
//$tagA = \Modules\Tag\Models\Tag::findOrCreate('staging1', 'domains');
//$tagA = \Modules\Tag\Models\Tag::findOrCreate('camera', 'domains');

@endphp
@foreach ($opts as $opt)
    <fieldset class="form-group border p-3">
        <legend class="w-auto px-2">{{ $opt }}</legend>
        <div class="mb-3">
            @php
                $tags = \Modules\Tag\Models\Tag::getWithType($opt);
                $values = $row->tagsWithType($opt);
                $values_ids = $values->pluck('id')->all();    
                if($values->count()<1){
                    $config_tags=config('tag.'.$opt);
                    if(!is_array($config_tags)){
                        throw new \Exception('put array on config [tag.'.$opt.']');
                    }
                    foreach($config_tags as $v){
                        \Modules\Tag\Models\Tag::findOrCreate($v['name'], $opt);
                    }
                }
                           


            @endphp
            {{-- se nessun checkbox e' settato non viene inviato valore --}}
            <input type="hidden" name="tags[]" />
            @foreach ($tags as $tag)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="tags[]" value="{{ $tag->id }}"
                        @checked(in_array($tag->id, $values_ids)) id="tag-{{ $tag->id }}" />
                    <label class="form-check-label" for="tag-{{ $tag->id }}">
                        {{ $tag->name }}
                    </label>
                </div>
            @endforeach
        </div>
    </fieldset>
@endforeach
