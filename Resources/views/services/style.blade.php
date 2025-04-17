@foreach($styles as $style)
<link href="{{asset($style)}}?{{ rand(1,10) }}" rel="stylesheet" type="text/css" />
@endforeach
