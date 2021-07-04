@extends('stocks.layout.app-stock')

@section('content')
<div class="p-4">
    @dd($uffVendite,
    $uffAcquisti,
    $uffContabile,
    $uffManagement)
    
    <h1 class="my-6 font-semibold text-3xl">Contatti</h1>
    <p style="max-width: 500px">
        Se hai bisogno di aiuto o delle semplici richieste di informazioni non esitare a contattarci inviandoci una email contattandoci telefonicamente ad uno dei nostri numeri.
    </p>
    <div class="my-16">
        <a class="-ml-3 px-3 py-2 text-gray-600 hover:bg-yellow-300 rounded" href="mailto:info@maerp.app">info@maerp.app</a>
    </div>


    {{-- <div style="max-width:900px" class="p-8 border-2 rounded-lg">
        <form action="" method="POST">
            <div class="mt-3 flex flex-col">
                <label>Nome *</label>
                <input type="text" name="nome" value="{{old('nome') ? old('nome') : ''}}">
            </div>

            <div class="mt-3 flex flex-col">
                <label>Email *</label>
                <input type="text" name="email" value="{{old('email') ? old('email') : ''}}">
            </div>

            <div class="mt-3 flex flex-col">
                <label>Oggetto *</label>
                <input type="text" name="oggetto" value="{{old('oggetto') ? old('oggetto') : ''}}">
            </div>

            <div class="mt-3 flex flex-col">
                <label>Messaggio *</label>
                <textarea name="messaggio" cols="15" rows="5">{{old('messaggio') ? old('messaggio') : ''}}</textarea>
            </div>

            <div class="mt-3">
                <button class="py-2 px-4 text-center bg-black rounded-md text-white text-sm hover:bg-gray-700">
                    Invia messaggio
                </button>
            </div>
        </form>
    </div> --}}

    <div class="mt-10">
        <h1 class="my-6 font-semibold text-3xl">Dove siamo</h1>
        <p class="font-semibold">
            Indirizzo dell'azienda: Via Duca d'Abruzzi, 1, 10014 Caluso (TO) ITALIA <br>
            Telefono: (+ 039 ) 333 63 21 195 <br>
            Email: info@maexportsrl.com <br>
        </p>
    </div>


    <div class="mt-10 flex flex-wrap">
        <div class="block">
            @php 
            $title = "font-semibold mt-2";
            $tex = "normal-case";
            @endphp

            <p class="leading-loose font-lg font-semibold mt-2 uppercase">Sede di Torino (Caluso)</p>
                <br>
                <p class="leading-loose">
                <span class="{{$title}}">Ufficio Vendite</span><br>

                <span class="{{$tex}} mt-1">Sara (English, Deutsch): +393203635839</span><br>
                <span class="{{$tex}}">Elena (Român, English) +393203635834</span><br>
                <span class="{{$tex}}">Bassem +393203635836 (العربية - français)</span><br>
                <span class="{{$tex}}">Davide (Italiano) +393297883215</span><br>

                <span class="{{$title}}">Ufficio Acquisti</span><br>
                <span class="{{$tex}} mt-1">Oleg (русский, English, Italiano) +393463281421</span>
            </p>
        </div>

        <div class="mr-0 md:ml-12 mt-8 md:mt-0 w-1/2 sm:w-4/12 md:w-3/12" style="min-width: 250px">

            <div class="block duration-700">
            <p class="leading-loose font-lg font-semibold mt-2 uppercase">Sede di Verona (Colognola ai Colli)</p>
            <br>
            <p class="leading-loose">
                <span class="{{$title}}">Ufficio Vendite</span><br>
                <span class="{{$tex}} mt-1">Roberto (Italiano) +393337100290</span><br>
                <span class="{{$tex}}">Isolda (русский, Italiano) +393473181020</span><br>
                <span class="{{$title}} mt-10">Sede Amministrativa</span><br>
                <span class="{{$tex}} mt-1">Alex (Italiano, Epol) +393336321195</span><br>
                <span class="{{$tex}}">Andrei (русский, Italiano) +393897622477</span>
            </p>
            </div>
        </div>
    </div>
</div>

@endsection