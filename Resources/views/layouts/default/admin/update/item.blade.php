@php
//dddx($_panel);
@endphp
@can('create', $row)
    <a class="btn btn-primary" href="{!! $_panel->url('create') !!}">
        Crea Nuovo
    </a>
@endcan
<a class="btn btn-primary" href="{!! url()->previous() !!}">
    Continua a Modificare
</a>
<a class="btn btn-primary" href="{!! $_panel->url('index') !!}">
    Torna alla Lista
</a>
