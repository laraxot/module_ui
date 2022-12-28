@php
$field = transFields(get_defined_vars());
$src = Form::getValueAttribute($name);
if ($src == '') {
    $src = asset('/img/nophoto.jpg');
}
//Theme::add('/dist/laravel-filemanager/js/stand-alone-button.js');
Theme::add('theme::js/uploadimgv2.js');
$field->attributes['id'] = 'post_image_src';
//dddx(get_defined_vars());
@endphp
@component($blade_component, get_defined_vars())
    @slot('label')
        {{ Form::label($name, $field->label, ['class' => 'control-label']) }}
    @endslot
    @slot('input')
        <div class="card mb-3">
            <div class="row no-gutters">
                {{-- <divclass="col-md-3"> --}}
                <div class="col-md-3 row">
                    {{-- <divid="holder"style="margin-top:1px;max-height:150px;"> --}}
                    <div id="holder" style="margin-top:1px;max-height:100%;">
                        @php
                            //<img class="card-img" src="{{ $src }}">
                        @endphp
                        <img class="card-img h-auto" src="{{ $src }}">
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="card-body">
                        <div class="input-group">
                            <span class="input-group-btn">
                                <a data-input="{{ $field->attributes['id'] }}" data-preview="holder"
                                    class="btn btn-primary text-white lfm_image">
                                    <i class="fa fa-picture-o"></i>
                                    @lang('theme::txt.select')
                                </a>
                            </span>
                            {{ Form::text($name, $value, $field->attributes) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>





    @endslot
@endcomponent
