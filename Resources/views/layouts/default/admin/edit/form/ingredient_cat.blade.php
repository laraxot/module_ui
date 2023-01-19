{!! Form::bsOpen($row,'update') !!}
{{ Form::bsText('title') }}
{{ Form::bsText('subtitle') }}
{{Form::bsSubmit('Aggiungi')}}
{!! Form::close() !!}