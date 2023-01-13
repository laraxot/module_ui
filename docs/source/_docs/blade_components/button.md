---
title: Button
description: Button
extends: _layouts.documentation
section: content
lang: it
id: 84
parent_id: 5
---

# Button {#button}

```php
<x-button.primary-button type="submit">
    Button Label
</x-button.primary-button>
```

```php
<x-button.secondary-button href="{{ route('forum') }}" x-show="activeTag">
    Remove filter
</x-button.secondary-button>
```

```php
<x-button type="advanced" class="mobile-full" :primary="true">
    <x-slot name="label">Avanti</x-slot>
</x-button>
```

## Button Crud {#button-crud}

Visualizza i tre bottoni crud (edit, show e delete) di un modello/istanza.
Come parametro riceve un pannello di un modello istanza.

Può anche visualizzare i tasti relativi alle tabs del pannello. Esempio:

```php
<x-button.crud :panel="Panel::make()->get(Auth::user())"></x-button.crud>
```

Questo componente utilizza componenti che creano il singolo bottone di un azione crud:
```php
<x-button.edit :panel="$panel" />
<x-button.delete :panel="$panel" />
<x-button.detach :panel="$panel" />
<x-button.show :panel="$panel" />
```

## Form Button {#form-button}

Bottone che crea l'html di un form:

```php
    <x-button.form-button class="btn btn-primary" action="/" method="GET" label="submit">
        <x-input.group type="text" name="firstname" />
    </x-button.form-button>
```

L'esempio riproduce:
```php
<form method="GET" action="/">
    <input type="hidden" name="_token" value="uGcpv0e4tV3SHfz8xwdOVTKcrhpXA0BQ0qyXL6CM"> 
    <input type="hidden" name="_method" value="GET"> <div class="form-group col-">
    <label for="firstname">xot::home.firstname.label</label>
    <input type="text" name="firstname" class="form-control" wire:model.lazy="form_data.firstname"></div>
    <button type="submit" class="btn btn-primary"> submit </button>
</form>
```

E' possibile aggiungere anche l'attributo style.

## Form Button {#form-button}
Crea il bottone del logout:

```php
<x-button.logout class="btn btn-primary"></x-button.logout>
```
