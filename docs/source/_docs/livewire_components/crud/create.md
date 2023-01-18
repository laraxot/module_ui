---
title: Crud Create
description: Crud Create
extends: _layouts.documentation
section: content
lang: it
id: 103
parent_id: 13
---

# Crud Create {#crud-create}

Mostra un componente che crea le CRUD dei modelli al volo.

PS Le CRUD sono le quattro operazioni di base per la gestione dei dati in un database, ovvero "Creare", "Leggere", "Aggiornare" e "Cancellare".

Nome Componente:

```php
livewire:crud.create
```

Parametri

```php
//nome del modello
string $modelName
```

Esempio:

```php
@php
$user_class=User::class;
@endphp

<livewire:crud.create
    :model-name="$user_class"
/>
```

NB Richiede il pacchetto laraxot/module_tenant

