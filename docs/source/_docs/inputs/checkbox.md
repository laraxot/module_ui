---
title: Checkbox
description: Checkbox
extends: _layouts.documentation
section: content
lang: it
id: 50
parent_id: 10
---

# Checkbox {#checkbox}

se si e' dentro livewire il valore e' dentro la variabile del componente livewire form_data.<$name>  

se no si passa dentro "value"

------

se è checkbox.arr :arr="$arr" :value="$value"

$arr è un array di tutti i valori possibili
$value è un array delle chiavi selezionate 

-------

se è checkbox.rows :rows="$rows" :value="$value"

$rows è una eloquent collection con tutti i valori 

$value è un array delle chiavi selezionate 


------

Esempio di input tipo checkbox da inserire nel proprio form
solitamente da utilizzare dentro un foreach 

```php
@php
$name="test";
$value=[3,5];
@endphp
@foreach($options as $k=>$v)
    <x-input.group type="checkbox" 
        :name="$name.'.'.$loop->index" 
        label="{{ $v }}" value="{{ $k }}" 
        {{ in_array($k,$value)?'checked':'' }} 
    />
@endforeach
```
questo deve equivalere a 

```php
@php
$name="test";
$value=[3,5];
@endphp
<x-input.group.arr type="checkbox" :arr="$options" :name="$name" />

```

La differenza tra <x-input.group.arr type="checkbox" /> e <x-input.group type="checkbox" /> è nella quantita delle opzioni.
L'aggiunta di arr indica che esiste più di una opzione nel checkbox o radio.

