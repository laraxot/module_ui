---
title: Input Arr Two
description: Input Arr Two
extends: _layouts.documentation
section: content
lang: it
id: 119
parent_id: 13
---

# Input Arr Two {#input-arr-two}

Crea un "input" di tipo array, cioè una lista di campi dove inserire i dati, in base ai parametri passati.
Per aggiornare al volo i form, bisogna che esista un componente livewire nella stessa pagina
con questo listener:

```php
'updatedFormDataEvent' => 'updateFormData',
```

Se questo listener non ci fosse in nessun componente, allora potrebbe passare i dati tramite url o post
in base ai metodi del form.

**In confronto al semplice arr, copia i dati della query string della ricerca avanzata nel campo query della ricerca normale**


Nome Componente:

```php
livewire:input.arr-two
```

Listeners

```php
//serve per aggiungere campi input al volo come array
//ad esempio se hai una lista di email da aggiungere al volo, puoi fare + per aggiungere un input alla lista
protected $listeners = ['addArr' => 'addArr'];
```
Parametri

```php
//tipo di input (deve corrispondere alle view in theme::livewire/input/arr/)
string $type
//attributo name dell'input
string $name
//label dell'input
?string $label
//array di valori di partenza dell'input
?array $value

//id del modello di partenza. 

//se nella richiesta dell'url passo dei dati, e inserisco un model-id,
//i dati dell'url vengono "uniti" a quelli del parametro value, se value è un array,
//e poi viene creata una variabile $data['rows'][$modelId] con i dati appena letti
//all'interno del componente. 

//Data poi viene messo in form_data ovvero nei dati di partenza del form
//Quindi poi andrò a salvare i dati del form nel modello con l'id corrispondente

//Per funzionare necessita che nella pagina esista un componente livewire con questo listener:
//'updatedFormDataRowsEvent' => 'updatedFormDataRowsEvent',
?int $modelId = null
```

Esempio:

```php
<livewire:input.arr-two type="text" name="nome" :value="[]" label="Il tuo nome" />
```

