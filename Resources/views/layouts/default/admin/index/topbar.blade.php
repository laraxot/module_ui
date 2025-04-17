@php
    if ($rows == null) {
        dddx($rows_err);
    }
    
@endphp
<nav class="navbar navbar-expand-lg navbar-light " style="background-color: #e9ecef; padding:5px;z-index:0;">
    @foreach ($_panel->getActions('container') as $act)
        @php
            try {
                echo $act->btnHtml();
            } catch (\Exception $e) {
                //dddx(['act'=>$act,'e'=>$e]);
            }
        @endphp
    @endforeach


    -
    @foreach ($_panel->getActions('check') as $act)
        @php
            try {
                echo $act->btnHtml();
            } catch (\Exception $e) {
                //dddx(['act'=>$act,'e'=>$e]);
            }
        @endphp
    @endforeach
    <p>
        <span class="primary-color"><strong>{{ number_format($rows->total(), 0, ',', ' ') }}</strong></span>
        {{ Str::plural($row->post_type ?? class_basename($row), $rows->total()) }}
    </p>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="col">
        </div>
        <x-form.panel.lang type="inline" />
        <x-form.search type="inline" />
        <x-form.panel.order type="inline" />
    </div>
</nav>

@pushOnce('scripts')
    <script>
        $('form').submit(function() {
            let values = [];
            $.each($('input[name="checkbox_model_id[]"]:checked'), function() {
                values.push($(this).val());
            });
            $('[name="model_ids"]').val(values.toString());

            return true;
        });
    </script>
@endPushOnce
