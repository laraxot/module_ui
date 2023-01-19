---
title: Input Slider
description: Input Slider
extends: _layouts.documentation
section: content
lang: it
id: 121
parent_id: 13
---

# Input Slider {#input-slider}

Mostra uno slider con un valore minimo e massimo.

***NB: Per aggiungere Nouislider in Laravel, è necessario prima installare 'nouislider'***

Nome Componente:

```php
livewire:input.slider
```

Listeners:

```php
'setSliderMinMax' => 'setMinMax',
'setSliderValues' => 'setValues',
```

Parametri

```php
//identificativo univoco dello slider
string $id
//driver (nome della view in pub_theme::livewire/input/slider)
//al momento c'è solo noui cioè la view di nouislider
?string $driver = null
```

Esempio:

```php
<livewire:input.slider id="slider01" driver="noui" />
```

