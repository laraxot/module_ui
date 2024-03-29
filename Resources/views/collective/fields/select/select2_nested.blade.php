<!-- select2_nested -->

{{-- Thanks to Erwan Pianezza - https://github.com/breizhwave --}}

{{-- This field assumes you have a nested set Eloquent model, using: --}}
{{-- 1. children() as a properly defined relationship --}}
{{-- 2. depth, lft attributes --}}

@php
    $current_value = old($field['name']) ? old($field['name']) : (isset($field['value']) ? $field['value'] : (isset($field['default']) ? $field['default'] : ''));
    
    if (!function_exists('echoSelect2NestedEntry')) {
        /**
         * @param $entry
         * @param $field
         * @param $current_value
         */ function echoSelect2NestedEntry($entry, $field, $current_value)
        {
            if ($current_value == $entry->getKey()) {
                $selected = ' selected ';
            } else {
                $selected = '';
            }
            echo "<option value='" . $entry->getKey() . "' '.$selected.'>";
            echo str_repeat('-', (int) $entry->depth - 1) . ' ' . $entry->{$field['attribute']};
            echo '</option>';
        }
    }
    
    if (!function_exists('echoSelect2NestedChildren')) {
        /**
         * @param $entity
         * @param $field
         * @param $current_value
         */ function echoSelect2NestedChildren($entity, $field, $current_value)
        {
            foreach ($entity->children()->get() as $entry) {
                echoSelect2NestedEntry($entry, $field, $current_value);
                echoSelect2NestedChildren($entry, $field, $current_value);
            }
        }
    }
@endphp

<div @include('crud::inc.field_wrapper_attributes')>
    <label>{!! $field['label'] !!}</label>
    @include('crud::inc.field_translatable_icon')
    <?php $entity_model = $crud->getRelationModel($field['entity'], -1); ?>
    <select name="{{ $field['name'] }}" style="width: 100%" @include('crud::inc.field_attributes', ['default_class' => 'form-control select2_field'])>

        @if ($entity_model::isColumnNullable($field['name']))
            <option value="">-</option>
        @endif

        @if (isset($field['model']))
            @php
                $obj = new $field['model']();
                $first_level_items = $obj
                    ->where('depth', '1')
                    ->orWhere('depth', null)
                    ->orderBy('lft', 'ASC')
                    ->get();
            @endphp

            @foreach ($first_level_items as $connected_entity_entry)
                @php
                    echoSelect2NestedEntry($connected_entity_entry, $field, $current_value);
                    echoSelect2NestedChildren($connected_entity_entry, $field, $current_value);
                @endphp
            @endforeach
        @endif
    </select>

    {{-- HINT --}}
    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif
</div>

{{-- ########################################## --}}
{{-- Extra CSS and JS for this particular field --}}
{{-- If a field type is shown multiple times on a form, the CSS and JS will only be loaded once --}}
@if ($crud->checkIfFieldIsFirstOfItsType($field, $fields))
    {{-- FIELD CSS - will be loaded in the after_styles section --}}
    @push('crud_fields_styles')
        <!-- include select2 css-->
        <link href="{{ asset('vendor/adminlte/bower_components/select2/dist/css/select2.min.css') }}" rel="stylesheet"
            type="text/css" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css"
            rel="stylesheet" type="text/css" />
    @endpush

    {{-- FIELD JS - will be loaded in the after_scripts section --}}
    @push('crud_fields_scripts')
        <!-- include select2 js-->
        <script src="{{ asset('vendor/adminlte/bower_components/select2/dist/js/select2.min.js') }}"></script>
        <script>
            jQuery(document).ready(function($) {
                // trigger select2 for each untriggered select2 box
                $('.select2_field').each(
                    function(i, obj) {
                        if (!$(obj).hasClass("select2-hidden-accessible")) {
                            $(obj).select2({
                                theme: "bootstrap"
                            });
                        }
                    });
            });
        </script>
    @endpush
@endif
{{-- End of Extra CSS and JS --}}
{{-- ########################################## --}}
