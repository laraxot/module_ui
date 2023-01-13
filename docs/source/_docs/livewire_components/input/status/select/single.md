---
title: Input Status Select Single
description: Input Status Select Single
extends: _layouts.documentation
section: content
lang: it
id: 117
parent_id: 13
---

# Input Status Select Single {#input-status-select-single}

Questo componente serve per cambiare al volo lo status di un modello.

Le funzioni getStatus e setStatus sono due metodi forniti dall'estensione laravel-model-status di Spatie per gestire lo stato di un modello in Laravel. 

getStatus viene utilizzato per recuperare lo stato corrente di un modello, mentre setStatus viene utilizzato per impostare lo stato di un modello su un nuovo valore.

In sostanza, queste funzioni consentono di aggiungere una proprietà di stato ai modelli di Laravel, che può essere utilizzata per tenere traccia dello stato di un determinato record del database, come ad esempio se è stato eliminato o se è stato sospeso. 

In questo modo, è possibile implementare una logica di business più avanzata nell'applicazione, ad esempio per evitare che un utente possa accedere a un determinato record se questo ha uno stato specifico.

Per aggiungere gli stati a un modello in Laravel, è necessario prima installare l'estensione laravel-model-status di Spatie utilizzando Composer. Dopo aver installato l'estensione, è possibile utilizzare il trait HasStatuses nel modello, come mostrato di seguito:

```php
use Spatie\ModelStatus\HasStatuses;

class User extends Model
{
    use HasStatuses;
}
```

Successivamente, è possibile definire gli stati disponibili per il modello utilizzando il metodo getPossibleStatuses nel modello stesso, come mostrato di seguito:

```php
use Spatie\ModelStatus\HasStatuses;

class User extends Model
{
    use HasStatuses;

    public function getPossibleStatuses(): array
    {
        return [
            'active' => 'Attivo',
            'inactive' => 'Inattivo',
            'suspended' => 'Sospeso',
            'deleted' => 'Eliminato',
        ];
    }
}
```

Una volta definiti gli stati disponibili per il modello, è possibile utilizzare i metodi getStatus e setStatus per recuperare e impostare lo stato di un modello, rispettivamente. Ad esempio:

```php
$user = User::find(1);

// Recupera lo stato corrente del modello
$status = $user->getStatus();

// Imposta lo stato del modello su "suspended"
$user->setStatus('suspended');
```

È anche possibile utilizzare il metodo hasStatus per verificare se un modello ha uno stato specifico, come mostrato di seguito:

```php
$user = User::find(1);

// Verifica se il modello ha lo stato "suspended"
if ($user->hasStatus('suspended')) {
    // Il modello ha lo stato "suspended"
}
```

Inoltre, l'estensione laravel-model-status fornisce anche altre funzionalità utili, come ad esempio la possibilità di definire stati che possono essere utilizzati solo in fase di creazione o di aggiornamento di un modello, o la possibilità di definire uno stato predefinito per il modello. Per ulteriori informazioni su come utilizzare queste funzionalità, si consiglia di consultare la documentazione ufficiale di laravel-model-status di Spatie.

Nome Componente:

```php
livewire:input.status.select.single
```

Parametri

```php
Model $model
array $options
```

Esempio:

```php
$user = \App\Models\User::first();
@endphp
<livewire:input.status.select.single :model="$user" :options="['uomo','donna','non specificato']" />
```


