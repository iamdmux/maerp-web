
@component('mail::message')
{{-- # Invio {{$doc}} --}}
Gentile cliente,<br> 
in allegato può trovare il documento in oggetto da visionare o scaricarne una copia.

@if(!$isElettronica)
Il documento andrà stampato e conservato per tutti i necessari adempimenti di Legge, come disposto dal DPR 633/72 (e succ. modifiche) e dalla risoluzione del Ministero delle Finanze PROT.450217 del 30 Luglio 1990.
@else
Il documento che andrà prelevato, archiviato e conservato per i fini e gli obblighi applicabili di legge (ad es.: individuazione della data di ricezione e adempimento artt. 2214 e 2220 c.c., 21 e 39 D.p.r. 633/1972 e disp.ni collegate) è però solo quello originale in formato XML firmato digitalmente e trasmesso e recapitato dal Sistema di Interscambio ai sensi dell?art. 3 del Provv.to Agenzia delle Entrate del 30/4/2018 e del d.m. 55/2013.
@endif

Cordiali saluti,<br> 
M&A Export
@endcomponent