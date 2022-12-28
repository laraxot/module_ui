---
title: Password
description: Password
extends: _layouts.documentation
section: content
lang: it
id: 53
parent_id: 10
---

# Password {#password}

Esempio di input tipo password da inserire nel proprio form

```php
<x-input.group label="Password" type="password" name="password" col_size="12" id="id_password" autocomplete="current-password"></x-input.group>
```

verrà renderizzato in questo modo

```php
<div class="form-group  col-12">
    <label for="id_password" class="">Password</label>
    
    <input type="password" name="password" class="form-control" wire:model.lazy="form_data.password" label="Password" col_size="12" id="id_password" autocomplete="current-password" data-focus-mouse="false">
</div>
```
