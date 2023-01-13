---
title: Input Group Arr
description: Input Group Arr
extends: _layouts.documentation
section: content
lang: it
id: 116
parent_id: 13
---

Crea una lista di campi raggruppati.

La prima volta chiede il gruppo nel quale raggruppare gli altri campi
e poi crea per ogni gruppo dei sotto-campi, sempre utilizzando il bottone +.

# Input Group Arr {#input-group-arr}

Nome Componente:

```php
livewire:input.group.arr
```

Parametri

```php
//tipo di input (per ora c'è solo text)
string $type
//attributo name dell'input
string $name
```

Esempio:

```php
<livewire:input.group.arr type="text" name="email" />
```

Esempio Risultato

```php
Lista Email 1
    davide@davide.it
    marco@marco.it

Lista Email 2
    mario@mario.it
    gianni@gianni.it
    lucia@lucia.it
```

