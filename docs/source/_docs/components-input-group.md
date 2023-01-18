---
title: Componenti Input Group
description: Componenti Input Group
extends: _layouts.documentation
section: content
lang: it
id: 6
parent_id: 0
---

# Componenti Input Group {#components-input-group}

La classe estende la classe Component e definisce diverse proprietà, tra cui tpl, data e options, nonché alcuni metodi, tra cui __construct, render e shouldRender. 

Diversi componenti blade vengono renderizzati in input html in base al type indicato,
con possibilità di specificare classe css, id ed eventualmente altri parametri che il tag richiede.

Il metodo shouldRender restituisce un valore booleano che indica se il componente deve essere renderizzato o meno.
