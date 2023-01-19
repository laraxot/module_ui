<div class="widget clearfix">
    <div class="widget-heading">
        <h3 class="widget-title text-dark">
            @lang($view.'.opening_hours')
        </h3>
        <div class="clearfix"></div>
    </div>
    @php
        $dayOfWeek = \Carbon\Carbon::now()->dayOfWeek;
        $daynames = ['sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat'];
    @endphp
    <div class="widget-body">
        @includeFirst([$view.'.item.add.opening_hours',$view_default.'.item.add.opening_hours'])
        <table class="table">
            {{-- <ul class="list-unstyled opening-hours"> --}}
            @for ($i = 0; $i < 7; $i++)
                {{-- <li @if ($i == $dayOfWeek) style="font-weight: 500;color:darkorange;" @endif> --}}
                <tr>
                    <td>@lang('pub_theme::txt.day_names_short.'.$daynames[$i])</td>
                    <td><span class="pull-right">
                            @foreach ($openingHours->where('day_of_week', $i)->sortBy('open_at') as $hour)
                                @if ($hour->is_closed)
                                    <span style="color:red">closed</span>
                                @else
                                    {{ $hour->open_at->format('H:i') }} - {{ $hour->close_at->format('H:i') }}
                                @endif
                                {{-- $hour->destroy_url --}}
                                @php
                                    //dddx($hour->pivot);
                                    /*
                                    $parz=$params;
                                    $parz['container1']='opening_hour';
                                    $parz['item1']=$hour->id;
                                    $destroy_url=route('containers.destroy',$parz);
                                    [{{ $hour->destroy_url }}]
                                    */
                                @endphp

                                {!! Form::bsBtnDelete(['row' => $hour]) !!}

                            @endforeach
                        </span></td>
                </tr>
                {{-- </li> --}}
            @endfor
            {{-- </ul> --}}
        </table>
        @foreach ($openingHours as $hour)
            @if (!$hour->is_closed)
                <meta itemprop="openingHours"
                    content="{{ substr($hour->day_name, 0, 2) }} {{ $hour->open_at->format('H:i') }}-{{ $hour->close_at->format('H:i') }}" />
            @endif
        @endforeach
    </div>
</div>
