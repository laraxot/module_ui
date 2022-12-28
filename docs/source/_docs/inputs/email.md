---
title: Email
description: Email
extends: _layouts.documentation
section: content
lang: it
id: 51
parent_id: 10
---

# Email {#email}

Esempio di input tipo email da inserire nel proprio form


```php
<x-input.group label="Email Address" type="email" name="email" col_size="12" id="id_login"></x-input.group>
```

verrà renderizzato in questo modo

```php
<div class="form-group  col-12">
    <label for="id_login" class="active">Email Address</label>
    
    <input type="email" name="email" class="form-control" wire:model.lazy="form_data.email" label="Email Address" col_size="12" id="id_login" data-focus-mouse="false">
</div>
```
