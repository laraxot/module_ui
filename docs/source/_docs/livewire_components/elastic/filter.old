---
title: Elastic Filter
description: Elastic Filter
extends: _layouts.documentation
section: content
lang: it
id: 108
parent_id: 13
---

# Elastic Filter {#elastic-filter}

Ti crea un pannello con i filtri per fare una ricerca più o meno avanzata con ElasticSearch.

Utilizza a sua volta il componente livewire:input.arr.

Se gli passi un modello di Eloquent come parametro lo usa per estrarre un array da $row->filter
e quelli saranno i valori di default del filtro stesso.

Ad esempio, se in un Model salvassi l'ultima ricerca in formato array o json facendo casting tramite il modello
quelli potrebbero essere utilizzati come parametri di "partenza" della ricerca.

Nome Componente:

```php
livewire:elastic.filter
```

Parametri

```php
?Model $row = null
```

Esempio:

```php
@php
//relation profile->hasOne->last_search
$last_search=$profile->last_search->get();
@endphp

<livewire:elastic.filter :row="$last_search" />
```

