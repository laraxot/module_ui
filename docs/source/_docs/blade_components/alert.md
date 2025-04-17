---
title: Alert
description: AcAlertcordion
extends: _layouts.documentation
section: content
lang: it
id: 81
parent_id: 5
---

# Alert {#alert}

```php
<div class="container-fluid m-5">
    <x-alert type="danger" title="titolo" :dismissable="false">
        testo interno
    </x-alert>
    <x-alert type="warning" title="titolo">
        testo interno
    </x-alert>
</div>
```