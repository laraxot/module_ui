---
title: Menu Builder
description: Menu Builder
extends: _layouts.documentation
section: content
lang: it
id: 123
parent_id: 13
---

# Menu Builder {#menu-builder}

Componente livewire utilizzato per creare un menu o una raccolta di menu. 

Ad ogni salvataggio o modifica di un menu, verranno salvati 2 file nella cartella di configurazione utilizzato del progetto:

1. laravel\config\it\dominio\sottodominio\menu_builder.php
memorizza in un array i menu salvati

2. laravel\config\it\dominio\sottodominio\menu_builder_item.php
memorizza in un array tutti gli elementi/url/voci dei singoli menu salvati

```php
<livewire:menu.builder />
```

## Funzione getMenuItemsByName

Funzione di Theme\View\Composers\ThemeComposer con cui si potrà recuperare tutte le voci di un menu salvato. Esempio di utilizzo:

```php
<!-- Side Nav START -->
<ul class="nav nav-link-secondary flex-column fw-bold gap-2">
    @foreach ($_theme->getMenuItemsByName('navbar') as $menu_item)
        <li class="nav-item">
            <a class="nav-link" href="#!">
                <a class="nav-link" href="{{ $menu_item->link }}">{{ $menu_item->label }}</a>
            </a>
        </li>
    @endforeach
</ul>
```