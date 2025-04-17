@props([
    'value' => null,
])
@php
    
    // dddx(get_defined_vars());
    // dddx($attributes->getAttributes());
    
    //Theme::add('/dist/laravel-filemanager/js/stand-alone-button.js');
    Theme::add('ui::js/uploadimgv2.js');
    // $field->attributes['id'] = 'post_image_src';
    //dddx(get_defined_vars());
@endphp

<div class="card mb-3">
    <div class="row no-gutters">
        {{-- <divclass="col-md-3"> --}}
        <div class="col-md-3 row">
            {{-- <divid="holder"style="margin-top:1px;max-height:150px;"> --}}
            <div id="holder" style="margin-top:1px;max-height:100%;">
                @php
                    //<img class="card-img" src="{{ $src }}">
                @endphp
                <img class="card-img h-auto" src="{{ $value }}">
            </div>
        </div>

        <div class="col-md-9">
            <div class="card-body">
                <div class="input-group">
                    <span class="input-group-btn">
                        <a data-input="{{ $name }}" data-preview="holder"
                            class="btn btn-primary text-white lfm_image">
                            <i class="fa fa-picture-o"></i>
                            @lang('ui::txt.select')
                        </a>
                    </span>
                    {{-- Form::text($name,$value,$field->attributes) --}}
                    <x-input type="text" :name="$name" :value="$value" :id="$name" />
                </div>
            </div>
        </div>
    </div>
</div>
