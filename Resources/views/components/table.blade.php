 @props(['heading', 'thead', 'tbody', 'tfood'])

 {{-- dddx(get_defined_vars()) --}}

 <table {{ $attributes->class([$table_class]) }}>
    @if(isset($thead))
     <thead {{ $thead->attributes->class(['thead-light']) }}>
         {{ $thead }}
     </thead>
    @endif
    <tbody>{{ $tbody ?? ''}}</tbody>
    {{ $slot }}
 </table>
