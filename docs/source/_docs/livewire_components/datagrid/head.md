---
title: Datagrid Head
description: Datagrid Head
extends: _layouts.documentation
section: content
lang: it
id: 104
parent_id: 13
---

# Datagrid Head {#datagrid-head}

Ritorna l'intestazione della tabella (th) in base ai campi di un modello.

Nome Componente:

```php
livewire:datagrid-editable.head
```

Parametri

```php
//item (riga) del modello
public mixed $row;
//indice (non serve a niente in realtà)
public string $index;
```

Esempio:

```php
@php
$user = \App\Models\User::make();
@endphp

<livewire:datagrid-editable.head :row="$user" index=0 />
```

