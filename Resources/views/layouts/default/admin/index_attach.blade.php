@extends('adm_theme::layouts.app')
@section('content')
    <div class="widget">
        <div class="widget-body">
            @include('theme::includes.flash')
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $k => $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {!! Form::model($row, ['url' => Request::fullUrl()]) !!}
            @method('post')
            <div class="row">
                @php
                    //$parent_rows=$_panel->getParent()->rows->get();
                    $name = Str::plural($_panel->postType());
                    //dddx($_panel->getRows());
                    $val = $rows = $_panel->getRows()->get();
                    $all = $_panel
                        ->getRows()
                        ->getRelated()
                        ->all();
                @endphp
                <fieldset class="form-group container-fluid border p-2">
                    <legend class="col-form-label col-sm-2 pt-0 w-auto">
                        <h4>{{ $name }}</h4>
                    </legend>

                    <div class="row" style="border:1px solid  dark;">
                        <div class="col-sm-12">
                            <p>{{ trans('lu::help.nota_multiselect') }}</p>
                        </div>
                        <br style="clear:both" />
                        <div class="col-sm-5">
                            <select name="{{ $name }}[from][]" id="multiselect{{ $name }}"
                                class="form-control multiselect" size="8" multiple="multiple">
                                @foreach ($all as $k => $v)
                                    {{-- <option value="{{ $v->opt_key }}" >{{ $v->opt_label }}</option> --}}
                                    <option value="{{ $_panel->optionId($v) }}">{{ $_panel->optionLabel($v) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <button type="button" id="multiselect{{ $name }}_rightAll" class="btn btn-block">
                                <i class="fas fa-angle-double-right"></i>
                            </button>
                            <button type="button" id="multiselect{{ $name }}_rightSelected" class="btn btn-block">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                            <button type="button" id="multiselect{{ $name }}_leftSelected" class="btn btn-block">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <button type="button" id="multiselect{{ $name }}_leftAll" class="btn btn-block">
                                <i class="fas fa-angle-double-left"></i>
                            </button>
                        </div>
                        <div class="col-sm-5">
                            <select name="{{ $name }}[to][]" id="multiselect{{ $name }}_to"
                                class="form-control" size="8" multiple="multiple">
                                @foreach ($val as $k => $v)
                                    {{-- <option value="{{ $v->opt_key }}" >{{ $v->opt_label }}</option> --}}
                                    <option value="{{ $_panel->optionId($v) }}">{{ $_panel->optionLabel($v) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </fieldset>

            </div>
            {{ Form::bsSubmit('save') }}
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        if (typeof $ == 'undefined') {
            var $ = jQuery;
        }
        //jQuery is not a function
        //jQuery(document).ready(function($) {
        $(function() {
            $('.multiselect').multiselect();

        });
    </script>
@endpush
