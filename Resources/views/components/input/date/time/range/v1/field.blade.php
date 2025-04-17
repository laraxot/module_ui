<div class="row">
    <input type="text" name="date_range" class="form-control form-control-lg flatpickr-daterange" />
    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
        <label class="form-check-label" for="flexCheckDefault">
          time
        </label>
    </div>

    <div class="input-group mb-3">
        <input type="text" name="time_from" class="form-control  form-control-lg flatpickr-time" />
        <input type="text" name="time_to" class="form-control  form-control-lg flatpickr-time" />
    </div>

</div>
@push('scripts')
<script>
    $(".flatpickr-daterange").flatpickr(
        {
            mode: "range",
            dateFormat: "Y-m-d",
            //enableTime: true,
            //noCalendar: true,
            //dateFormat: "H:i",
            //time_24hr: true,
            //"minDate": new Date().fp_incr(1),
            //"maxDate": new Date().fp_incr(7)
        }
    );

    $(".flatpickr-time").flatpickr(
        {
            mode: "range",
            //dateFormat: "Y-m-d",
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true,
            //"minDate": new Date().fp_incr(1),
            //"maxDate": new Date().fp_incr(7)
        }
    )
</script>
@endpush