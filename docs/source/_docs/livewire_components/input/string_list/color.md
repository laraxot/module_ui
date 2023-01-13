---
title: Input StringList Color
description: Input StringList Color
extends: _layouts.documentation
section: content
lang: it
id: 118
parent_id: 13
---

# Input StringList Color {#input-string_list-color}

Crea una lista di input per inserire i colori e poi salvarli in un modello tramite richiesta da form

Nome Componente:

```php
livewire:input.string-list.color
```

Parametri

```php
//attributo name input
string $name
//valore iniziale (ad esempio mettendo #ffffff parte dal bianco)
?string $value
```

Esempio:

```php
<livewire:input.string-list.color name="color" value="#ffffff" />
```

