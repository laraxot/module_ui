<div>
    <div class="row">
        <div class="form-select-wrapper mb-4 col-md-4">
            <x-input.group type="select" class="form-select" name="order_by" remove_first_empty_option="true" :options="['desc' => 'Discendente', 'asc' => 'Ascendente']" label_class="h3"
                id="order_by"></x-input.group>
        </div>
        <div class="form-select-wrapper mb-4 col-md-4">
            <x-input.group type="date.datetime.range" class="form-select" name="calendar" id="calendar" label_class="h3">
            </x-input.group>
        </div>
        <div class="form-select-wrapper mb-4 col-md-4">
            <x-input.group type="select" class="form-select" name="type" remove_first_empty_option="true" :options="$_theme->getMediaTypeList()" label_class="h3"
                id="media_type"></x-input.group>
        </div>
    </div>
</div>
