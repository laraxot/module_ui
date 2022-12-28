---
title: Card Poster Txt
description: Card Poster Txt
extends: _layouts.documentation
section: content
lang: it
id: 102
parent_id: 13
---

# Card Result Panel {#card-result-panel}

Serve per creare una barra per spostarsi tra le "citazioni".

Cerca la sottostringa q nel modello associato al panel, in row->txt.

Si muove con utilizzando àncore dell'url.

Nome Componente:

```php
livewire:card.result.panel
```

Parametri

```php
//contratto (interfaccia) del Panel
PanelContract $panel
//query sting di inizio (dell'url)
string $q, 
```

Esempio:

```php
<livewire:card.result.panel
    :panel="$_panel"
    q="mario"
/>
```

