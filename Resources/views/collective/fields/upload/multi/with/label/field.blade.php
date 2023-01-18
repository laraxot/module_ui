@php

/* serve prendere una Relation del pannello chiamante e metterla in una variabile.
    Name è il nome della relazione che viene passato nel field del Panel. */

$related = $_panel->row->{$name}()->getRelated();

/* prende il panello del modello che è relazionato in related */

$related_panel = Panel::make()->get($related);

/* serve per creare una Relation dalla relation $related,
    altrimenti ti trovi incasinato con le query successive, in certi casi
    In questo caso si può cacellare perchè uso il builer per fare il foreach
    */

/*$related_panel->setRows($related->whereRaw('1=1'));*/

/* serve per creare una Builder dalla relation $related,
 altrimenti ti trovi incasinato con le query successive, in certi casi */

$related_panel->setBuilder($related->whereRaw('1=1'));

/* è un foreach che mi fa un array con id e label dal Builder*/

$rows = $related_panel->optionsSelect();

@endphp

<table>

    @foreach ($rows as $index => $value)

        <tr>
            <td>{{ $index }}</td>
            <td>{{ $value }}</td>
            <td>{{ Form::bsPdf('test') }}</td>
        </tr>

    @endforeach

</table>
