---
title: Input Group vs Input
description: Input Group vs Input
extends: _layouts.documentation
section: content
lang: it
id: 10
parent_id: 0
---

# Input Group vs Input {#input-group-vs-input}

La classe Input.php estende la classe Component e definisce diverse proprietà, tra cui **attrs**, **type**, **name** e **options**, oltre a un metodo chiamato __construct.

La classe Input crea un elemento di input del modulo, con il metodo __construct utilizzato per impostare le varie proprietà dell'input in base agli argomenti forniti. 

Il metodo render viene utilizzato per generare l'HTML per l'elemento di input in base alle proprietà e alle opzioni impostate nel metodo __construct. 

La classe Input ha anche una logica per impostare attributi e classi specifici per diversi tipi di input, come select, checkbox o radio.


La classe Input/Group.php definisce una classe chiamata Group che estende la classe Component. Questa classe Group ha lo scopo di richiamare un gruppo di elementi di un form, come un gruppo di radio o checkbox, input testo, texarea ecc, con tanto di label

