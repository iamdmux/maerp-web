@extends('stocks.layout.app-stock')

@section('content')
<div class="p-4 w-full xl:w-3/4">
    
    <h1 class="my-6 font-semibold text-3xl">Chi siamo</h1>
    <img src="{{asset('img/chisiamo-magazzino.jpg')}}" alt="magaazzino" class="w-full rounded">
    <p class="mt-10">
        Noi di M&A Export Srl, nati nel 2015, siamo diventati azienda leader riconosciuta nello stock di abbigliamento, calzature e accessori dei migliori marchi italiani e internazionali.
    </p>
    @php
    $w = 'w-6 h-6';
        $stats = [
            0 => [
                'num' => '10.000.000',
                'um' => 'pezzi',
                'desc' => 'venduti ogni anno',
                'icon' => '<svg class="' .$w.' mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>'
            ],
            1 => [
                'num' => '+40',
                'um' => 'marche',
                'desc' => 'commercializzate',
                'icon' => '<svg class="' .$w.' mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>'
            ],
            2 => [
                'num' => '10.000',
                'um' => 'mq',
                'desc' => 'di magazzino',
                'icon' => ' <svg class="' .$w.' mx-auto" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11 17a1 1 0 001.447.894l4-2A1 1 0 0017 15V9.236a1 1 0 00-1.447-.894l-4 2a1 1 0 00-.553.894V17zM15.211 6.276a1 1 0 000-1.788l-4.764-2.382a1 1 0 00-.894 0L4.789 4.488a1 1 0 000 1.788l4.764 2.382a1 1 0 00.894 0l4.764-2.382zM4.447 8.342A1 1 0 003 9.236V15a1 1 0 00.553.894l4 2A1 1 0 009 17v-5.764a1 1 0 00-.553-.894l-4-2z"></path>
                            </svg>'
            ],
            3 => [
                'num' => '2.000',
                'um' => 'mq',
                'desc' => 'di uffici',
                'icon' => '<svg class="' .$w.' mx-auto" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd"></path></svg>'
            ],
            4 => [
                'num' => '29',
                'um' => '',
                'desc' => 'dipendenti',
                'icon' => '<svg class="' .$w.' mx-auto" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>'
            ],
        ];
    @endphp


    <section class="flex flex-wrap justify-around my-24 text-center uppercase tracking-wider">
        @foreach ($stats as $stat)
        <div class="flex-grow-0 w-52 mb-16 text-sm">
            {{-- {!!$stat['icon']!!} --}}
            <p class="mt-3"><span class="text-2xl font-semibold">{{$stat['num']}}</span> {{$stat['um']}}</p>
            <p>{{$stat['desc']}}</p>
        </div>
        @endforeach
    </section>

    <div class="flex flex-wrap">
        <div class="flex flex-col justify-center w-full lg:w-1/2 lg:pr-6">
            <div>
                <h3 class="text-2xl font-semibold">Dove acquistiamo</h3>
                <p class="mb-8">Acquistiamo principalmente in Europa e organizziamo anche il ritiro delle merci direttamente dalle sedi internazionali con conseguente abbattimento dei costi di dogana e di logistica.</p>
            </div>
            <div>
                <h3 class="text-2xl font-semibold">Dove vendiamo</h3>
                <p class="mb-8">Esportiamo il 90% in Paesi fuori dall’Italia, coprendo oltre 60 nazioni.</p>
            </div>
            <div class="mb-6">
                <h3 class="text-2xl font-semibold">La nostra missione</h3>
                <p>La nostra missione è la sostenibilità ambientale con lo scopo preciso di ridurre i rifiuti e contenere l’impatto ambientale. Per questo motivo acquistiamo stock di stagioni passate, resi da negozi, resi da e-commerce, sovraproduzioni, prodotti difettosi alla produzione e prodotti danneggiati.</p>
            </div>
        </div>
        <div class="w-full lg:w-1/2">
            <img src="{{asset('img/chisiamo-export.jpg')}}" alt="magaazzino" class="w-full rounded">
        </div>
    </div>

    <div class="my-24 p-8 bg-gray-100 border border-black rounded">
        <h3 class="text-2xl font-semibold mb-1">I vantaggi per i nostri fornitori partner</h3>
        <p>Collaboriamo con le aziende partner ritirando le loro merci obsolete e reimettendole in un nuovo ciclo commerciale, attraverso i nostri canali internazionali consolidati, nei distretti geografici più ricettivi.</p>
    </div>
    <div class="flex flex-wrap">
        <div class="w-full lg:w-1/2 lg:pr-6">
           @php
               $list = [
                   'Acquisto con procedure snelle per liberare spazio logistico in modo efficiente',
                   'Pagamento anticipato',
                   'Gestione della packing list in modalità riservata',
                   'Tutela del brand e delle clausole di restrizione commerciale internazionale',
                   'Disponibilità all’acquisto di grandi quantità',
                   'Partecipazione nel progetto di ecosostenibilità',
                   'Coinvolgimento in azioni di beneficienza',
                   'Recupero di liquidità',
                   'Disponibilità a contrattualizzare gli acquisti periodici e continuativi'
            ];
           @endphp
            <h4 class="font-semibold text-lg">In particolare, offriamo:</h4>
            <div class="pl-6 mt-16 mb-6">
                <ul>
                    @foreach ($list as $li)
                        <li style="list-style-type: disc;" class="mb-1">{{$li}}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="w-full lg:w-1/2">
            <img src="{{asset('img/chisiamo-vetrina.jpg')}}" alt="magaazzino" class="w-full rounded">
        </div>
    </div>
@endsection