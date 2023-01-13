---
title: Card Poster Result Txt
description: Card Poster Result Txt
extends: _layouts.documentation
section: content
lang: it
id: 101
parent_id: 13
---

# Card Poster Result Txt {#card-poster-txt}

Serve per creare una barra per spostarsi tra le "citazioni".

Cerca la sottostringa q nel testo txt.

Si muove con utilizzando àncore dell'url.

Nome Componente:

```php
livewire:card.poster.result.txt
```

Parametri

```php
//query sting di inizio (dell'url)
string $q, 
//testo da cercare
string $txt, 
//url di partenza
string $url
```

Esempio:

```php
<livewire:card.poster.result.txt
    q="mario"
    txt="mario era molto bello. chi conoceva mario si sorprendeva di questo. mario era contento."
    :url="url('/')"
/>
```

