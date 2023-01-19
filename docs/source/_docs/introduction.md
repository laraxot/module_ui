---
title: Introduction
description: Introduzione al modulo Theme.
extends: _layouts.documentation
section: content
lang: it
id: 12
parent_id: 0
---

# Introduction {#Introduction}

This is a starter template for creating a beautiful, customizable documentation site for your project with minimal effort. You’ll only have to change a few settings and you’re ready to go.


Il modulo "module_ui" è un pacchetto per Laravel che fornisce funzionalità per la creazione di interfacce utente avanzate. Il modulo include componenti pre-costruiti per elementi comuni delle interfacce utente, come pulsanti, moduli di input e tabelle, nonché funzionalità per la gestione dei temi e lo stile dell'interfaccia.

Per utilizzare il modulo, è necessario installarlo tramite Composer con il comando composer require laraxot/module_ui. Una volta installato, il modulo può essere utilizzato nell'applicazione Laravel tramite il seguente codice:

Copy code
use Laraxot\ModuleUI\Facades\ModuleUI;
Per utilizzare i componenti del modulo, è possibile utilizzare i blade components di Laravel. Ad esempio, per utilizzare il componente pulsante, è possibile utilizzare il seguente codice nella vista blade:

```
<x-module-ui-button>Pulsante</x-module-ui-button>
Per ulteriori informazioni su come utilizzare il modulo e sui componenti disponibili, consultare la documentazione disponibile nel repository su GitHub.
```

Il modulo "module_uikit" è un pacchetto per Laravel che fornisce l'accesso al framework front-end UIkit. UIkit è un framework CSS, HTML e JavaScript per lo sviluppo di interfacce utente responsive e moderne.

Per utilizzare il modulo, è necessario installarlo tramite Composer con il comando composer require laraxot/module_uikit. Una volta installato, il modulo può essere utilizzato nell'applicazione Laravel tramite il seguente codice:

Copy code
use Laraxot\ModuleUIKit\Facades\ModuleUIKit;
Per utilizzare i componenti di UIkit, è possibile utilizzare il helper uikit() fornito dal modulo. Ad esempio, per utilizzare il componente pulsante di UIkit, è possibile utilizzare il seguente codice nella vista blade:

Copy code
{!! uikit('button')->text('Pulsante') !!}
Per ulteriori informazioni su come utilizzare il modulo e sui componenti di UIkit disponibili, consultare la documentazione disponibile nel repository su GitHub.

