---
title: Import Xls Model
description: Import Xls Model
extends: _layouts.documentation
section: content
lang: it
id: 115
parent_id: 13
---

# Import Xls Model {#import-xls-model}

Mostra un pannello per importare un Xls all'interno di un modello.

Si possono specificare anche i campi o traduzioni nei quali importare i dati.

Nome Componente:

```php
livewire:import.xls.model
```

Parametri

```php
//classe del modello nel quale importare i dati
string $modelClass
//campi
?array $fields
//traduzioni
?array $trans
```

Esempio:

```php
@php
$warehouse_article=\App\Models\WarehouseArticle::class;
@endphp
<livewire:import.xls.model :model-class="$warehouse_article" />
```

