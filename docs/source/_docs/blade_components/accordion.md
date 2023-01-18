---
title: Accordion
description: Accordion
extends: _layouts.documentation
section: content
lang: it
id: 80
parent_id: 5
---

# Accordion {#accordion}

Rappresenta un componente Accordion. 

Il componente verrà renderizzato utilizzando una vista Blade, che sarà determinata dalla proprietà $type, che di default richiamerà la blade **theme::components.accordion.rows.v1**

Il componente verrà inizializzato con una collection di dati, che sarà disponibile come proprietà $rows. 

```php
<x-accordion.container id="accordion-0">
    <x-accordion.item id="accordion-item-0" title="titolo" i="0">
        descrizione
    </x-accordion.item>
    <x-accordion.item id="accordion-item-1" title="titolo 1" i="1">
        descrizione 1
    </x-accordion.item>
</x-accordion.container>
```