---
title: Card
description: Card
extends: _layouts.documentation
section: content
lang: it
id: 86
parent_id: 5
---

# Card {#card}

Il componente Modules\UI\View\Components\Card.php crea un semplice card.
Esempio di utilizzo:

```php
<x-card>
    <x-slot name="title">titolo</x-slot>
    <x-slot name="txt">
        txt
    </x-slot>
    <x-slot name="footer">
        footer
    </x-slot>
</x-card>
```

E' possibile inserire anche una proprietà **type** per richiamare una differnte blade. Di default la blade richiamata è UI\Resources\views\components\card\card.blade.php.