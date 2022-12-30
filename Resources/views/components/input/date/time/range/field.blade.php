@props(['name'])

<div class="datetime_range_picker" id="{{ Str::slug($name) }}"
    style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%" wire:ignore>
    <i class="fa fa-calendar"></i>&nbsp;
    <span></span> <i class="fa fa-caret-down"></i>

    <div style="display:none">
        <br />{{ $name }}<br />
        <input type="text" name="date_from" wire:model.lazy="form_data.{{ $name }}_from">
        <input type="text" name="date_to" wire:model.lazy="form_data.{{ $name }}_to">
    </div>
</div>

@push('scripts')
    <script>
        $(function() {
            moment.locale('it');

           var start = moment($('#{{ Str::slug($name) }} [name="date_from"]').val());
           if (!start.isValid()) {
               start = moment().subtract(29, 'days').set('hour', 0).set('minute', 0).set('second', 0);
           }
           var end = moment($('#{{ Str::slug($name) }} [name="date_to"]').val());
           if (!end.isValid()) {
               end = moment().set('hour', 23).set('minute', 59).set('second', 59);
           }


           function cb(start, end) {
               $('#{{ Str::slug($name) }} span').html(start.format('D MMM YYYY HH:mm') + ' - ' + end.format(
                   'D MMM YYYY HH:mm'));
               $('#{{ Str::slug($name) }} [name="date_from"]').val(start.format('yyyy-MM-DDTHH:mm:ss'))
               $('#{{ Str::slug($name) }} [name="date_to"]').val(end.format('yyyy-MM-DDTHH:mm:ss'))
               //console.log("{{ $name }}");
               @this.emit('setFormDataValueEvent', "{{ $name }}_from", start.format(
                   'yyyy-MM-DDTHH:mm:ss'));
               @this.emit('setFormDataValueEvent', "{{ $name }}_to", end.format('yyyy-MM-DDTHH:mm:ss'));
               @this.emit('updatedFormDataRowsEvent', @this.form_data);
           }


           $('#{{ Str::slug($name) }}').daterangepicker({
               timePicker: true,
               timePicker24Hour: true,
               startDate: start,
               endDate: end,
               ranges: {
                   'Today': [moment(), moment()],
                   'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                   'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                   'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                   'This Month': [moment().startOf('month'), moment().endOf('month')],
                   'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                       'month').endOf('month')]
               }
           }, cb);

           cb(start, end);
        });
    </script>
@endpush

