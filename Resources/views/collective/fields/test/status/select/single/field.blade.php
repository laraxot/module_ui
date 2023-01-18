@php

//dddx(get_defined_vars());
@endphp
<div class="form-group col-sm-12">
    <livewire:input.status.select.single :model="$_panel->row" :options="$_panel->getStatusesList()" />
</div>
