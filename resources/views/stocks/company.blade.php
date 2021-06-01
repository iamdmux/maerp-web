@extends('stocks.layout.app-stock')

@section('content')
<div class="p-4">
    
    <h1 class="my-6 font-semibold text-3xl">Chi siamo</h1>
    <p style="max-width: 900px">
        La M.A. Export è una società che offre una vasta gamma di prodotti d'abbigliamento, provenienti da liquidazioni dei migliori marchi europei più noti e dalle migliori raccolte di indumenti usati in Europa. La sede principale si trova in Italia, l'azienda esporta i propri articoli in tutto l'est Europa ed in altri 36 Paesi al di fuori della comunità europea. La società è in costante crescita grazie all'ampia gamma di prodotti che dispone per uomo, donna, teenager, bambino, borse, scarpe e accessori. 
    </p>

    <div class="my-10">
        <img class="h-56 object-cover rounded" src="{{asset('stocks-media/chisiamo/import-export.png')}}" alt="">
    </div>
    <p style="max-width: 900px">
        M & A Export è azienda dedicata al commercio di stock di abbigliamento, scarpe, accessori e materiali dell' attuale stagione di moda e di quelle recenti. La M&A Export ha instaurato solidi rapporti commerciali con larga parte deile migliori etichette di moda a livello internazionale, costruendo una solida rete commerciale in un gran numero di paesi fuori dall' Europa. Questo garantisce importanti volumi di vendita durante l' anno ed una costante curva di crescita. 
    </p>
    
    <div class="my-10">
        <img class="h-56 object-cover rounded" src="{{asset('stocks-media/chisiamo/import-export-2.jpg')}}" alt="">
    </div>
    <p style="max-width: 900px">
        L'ampia gamma di etichette di moda che la M & A Export offre ai propri clienti proviene principalmente dall' Europa, USA e Canada. La disponibilità e l' affidabilità della M & A Export ha conquistato la fiducia dei propri clienti facendo della professionalità il proprio punto di forza. La società è in continuo contatto con i propri fornitori ed il reparto vendite garantisce la possibilità di ricerche e studi mirati per garantire la targhettizzazione delle vendite a secondo del brand. 
    </p>

</div>

@endsection