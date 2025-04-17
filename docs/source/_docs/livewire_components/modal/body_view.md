---
title: Modal Body View
description: Modal Body View
extends: _layouts.documentation
section: content
lang: it
id: 124
parent_id: 13
---

# Modal Body View {#modal-body-view}

Serve per creare la pagina di un modal

Nome Componente:

```php
livewire:modal.body-view
```

Proprietà pubbliche del componente

```php
//indica se il modal è visibile oppure no
public bool $show = false;
public string $body_view;
public string $modal_id;
public string $title;
public ?string $subtitle;
```

Proprietà del ***costruttore***

```php
//identificativo univoco del modal
string $id
//titolo da scrivere del modal
string $title
//sottotitolo da scrivere nel modal
string $subtitle = null
//percorso della view interna al "contorno" del modal (es. pub_theme::modal.profile_edit)
string $bodyView
```

Listeners

```php
//mostra il modal
'showModal' => 'showModal',
//chiude il modal
'doClose' => 'doClose',
//invia un session()->flash('message', $msg)
'sendMessage' => 'sendMessage',
```

Metodi pubblici

```php
//invia un evento di nome $event con modal_id e form_data, che verrà catturato da altri componenti
//se $event non è specificato il nome dell'evento sarà updateDataFromModal
public function sendData(?string $event = null)
```

Esempio:

```php
<livewire:modal.body-view show="$show" id="profile_edit" title="Edit Profile" subtitle=""
    bodyView="lu:modal.profile.edit">
</livewire:modal.body-view>
```

NB A sua volta, ***la view interna può contenere altri componenti***, quindi avere la sua ***logica*** e ***view***