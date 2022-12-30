{!! Form::bsOpen($row,'store',"",null,"createRestaurantForm") !!}
<div class="row">
    <div class="form-group col-sm-6">
        {{ Form::bsText('first_name') }}
    </div>
    <div class="form-group col-sm-6">
        {{ Form::bsText('last_name') }}
    </div>
    <div class="form-group col-sm-6">
        {{ Form::bsText('email') }}
    </div>
    <div class="form-group col-sm-6">
        {{ Form::bsText('handle') }}
    </div>
    <div class="form-group col-sm-6">
        {!! Form::bsPassword('passwd') !!}
    </div>
    <div class="form-group col-sm-6">
        {{ Form::bsPassword('passwd_confirmation') }}
    </div>
    {{--
    <div class="form-group col-sm-12">
        <h2><a href="#" class="js-registered">@lang($view.'.prvPrivacy')</a></h2>
    </div>
    --}}
    <div class="bg-gray col-lg-8 col-xlg-9 col-md-7">
        <div class="form-group col-sm-12">
            <h2><a href="#" class="js-registered">@lang($view.'.prvPrivacy')</a></h2>
        </div>
        @for($i=0;$i<4;$i++)
        <div class="form-group col-sm-12">
            @php
            $k="cons_checkbox_".$i;
            @endphp
            {!! Form::bsPrvModal('linked['.$k.']') !!}
            {!! Form::hidden('linked['.$k.'_txt]',trans('food::privacy.'.$k)) !!}
        </div>
        @endfor
        <div class="form-group col-sm-12">
            @lang($view.'.mandatoryPrivacy')
        </div>
    </div>
    {{-- Form::bsFlagsBoxed() --}}
    {{--
    <div class="form-group col-sm-12">
        @lang($view.'.mandatoryPrivacy')
    </div>
    --}}
</div>
<div class="row">
    {{ Form::bsSubmit(__($view.'.submit'),null,['class'=>"btn btn-success btn-round btn-lg" , 'style'=>"color: white; border-radius: 25px 0px 25px 0px; box-shadow: 2px 2px 2px 2px #00000029"]) }}
</div>
{{ Form::close() }}
