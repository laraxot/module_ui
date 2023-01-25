---
title: Menu
description: Menu
extends: _layouts.documentation
section: content
lang: it
id: 16
parent_id: 0
---

# Menu {#menu}

Il menu a sinistra nella dashboard del pannello di amministrazione, sotto la voce menu, prende i dati dalla funzione getModuleMenuByModuleName in laravel/Modules/Cms/View/Composers/ThemeComposer.php. 

A sua volta la funzione getModuleMenuByModuleName pesca i dati dal modello laravel/Modules/UI/Models/Menu.php.

Menu.php ha la funzione rowsPaginated che prende i dati dai file Modules/NOME_MODULO/Resources/menu/menus.php e Modules/NOME_MODULO/Resources/menu/menu_items.php