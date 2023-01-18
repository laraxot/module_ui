---
title: Toggle Date
description: Toggle Date
extends: _layouts.documentation
section: content
lang: it
id: 122
parent_id: 13
---

# Toggle Date {#toggle-date}

Mostra un checkbox con uno stile più carino, simil swipe.

Nome Componente:

```php
livewire:input.toggle-date
```

Proprietà pubbliche del componente

```php
public Model $model;
public string $field;
public bool $isActive;
```

Esempio:

```php
<livewire:theme.input.toggle-date model="$myModel" field="my_field" />
```