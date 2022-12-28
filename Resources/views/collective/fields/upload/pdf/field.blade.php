@php
$field = transFields(get_defined_vars());
$src = Form::getValueAttribute($name);
if ($src == '') {
    $src = asset('/img/nophoto.jpg');
}
//Theme::add('/dist/laravel-filemanager/js/stand-alone-button.js');
Theme::add('theme::/js/uploadimgv2.js');

$field->attributes['id'] = 'post_image_src_' . $field->label;
//dddx(get_defined_vars());
@endphp
@component($blade_component, get_defined_vars())
    @slot('label')
        {{-- Form::label($name,$field->label,['class'=>'control-label']) --}}
    @endslot
    @slot('input')
        <!--<div class="card mb-3">
                                                                                                                                                                            <div class="row no-gutters">


                                                                                                                                                                                <div class="col-md-9">
                                                                                                                                                                                    <div class="card-body">-->
        <div class="input-group">
            <span class="input-group-btn">
                <a data-input="{{ $field->attributes['id'] }}" data-preview="holder" class="btn btn-danger text-white lfm_pdf">
                    <!--<i class="fa fa-picture-o"></i>-->
                    @lang('theme::txt.select')
                </a>
            </span>
            {{ Form::hidden('path[]', $value, $field->attributes) }}
        </div>
        <!--</div>
                                                                                                                                                                                </div>
                                                                                                                                                                            </div>
                                                                                                                                                                        </div>-->





    @endslot
@endcomponent
