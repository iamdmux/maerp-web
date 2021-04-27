<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Fattura</title>
<script>
  this.name = "viewpdf";
</script>

<style type="text/css">
     @import url('https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap');

    body {
        font-family: 'Source Sans Pro', sans-serif;
        font-size: 0.75rem;
    }
    .gray {
        background-color: lightgray
    }
    table{
        border-collapse: collapse;
    }
    .fattura{
      border-bottom: 1px solid lightgray;
    }
    .fattura thead tr th{
        border-bottom: 1px solid lightgray;
        border-top: 1px solid lightgray;
    }
    .fattura th, .fattura td {
        border-left: 1px solid lightgray;
        border-right: 1px solid lightgray;
    }
    .fattura tr td:first-child,
    .fattura tr th:first-child {
      border-left: 0;
    }
    .fattura tr td:last-child,
    .fattura tr th:last-child {
      border-right: 0;
    }
    .fattura th, .fattura td{ /* Added padding for better layout after collapsing */
        padding: 8px 4px;
    }
    .fattura tbody tr:nth-child(odd) {
      background: rgb(241, 241, 241);
    }
    .title-small{
      font-size: 0.5rem;
    }
    .bottom-table{
      margin-top:50px;
      width:100%;
      /* position:absolute;
      bottom:100px; */
      /* border-top: 1px solid lightgray; */
      border-bottom: 1px solid lightgray;
    }
    
    /* .bottom-table td:first-child{
      border-right: 1px solid lightgray;
    } */
    /* .top {
      height: 900px;
      max-height: 900px;
    } */
    .bottom-left-table td, .bottom-left-table td *{
      vertical-align: top;
    }
</style>



</head>
<body>
  <div class="top">
    @if($fattura->documento_di_trasporto)
      <p style="text-align:right; font-size:14px; margin:0;">DOCUMENTO DI TRASPORTO<br> N° {{$fattura->numero_ddt}}/{{date('Y', strtotime($fattura->data_ddt))}} del {{date('d-m-Y', strtotime($fattura->data_ddt))}}</p>
    @else
      @php
          $dicitura = '';

          if($fattura->tipo_documento == 'preventivo'){
            $dicitura = 'PREVENTIVO';
          } elseif($fattura->tipo_documento == 'ordine'){
            $dicitura = 'ORDINE';
          } elseif($fattura->tipo_documento == 'proforma'){
            $dicitura = 'PROFORMA';
          } elseif ($fattura->tipo_documento == 'fattura') {
            $dicitura = 'FATTURA';
          }
      @endphp
      
      <p style="text-align:right; font-size:14px; margin:0;">{{$dicitura}} N° {{$fattura->numero}}/{{date('Y', strtotime($fattura->data))}} del {{date('d-m-Y', strtotime($fattura->data))}}</p>
    @endif

  <table width="100%">
    <tr>
    	<td align="left" width="50%">
        <div>
          {{-- <img src="https://via.placeholder.com/80" alt="M&A EXPORT" /> --}}
          <img src="{{ public_path() . '/img/logo-mea.png' }}" alt="M&A EXPORT" style="width: 90px;" />
        </div>
        <div style="margin-top:20px;">
          <p style="line-height: 12px;">
            <b>M&A EXPORT s.r.l</b><br>
            Via Italia 21<br>
            10035 MAZZE' (TO)<br>
            BANCA intesa sanpaolo<br>
            IBAN: IT73C0306930210100000016183<br>
            swift code: BCITITMMXXX<br>
            P.IVA: IT11320520015<br>
            CF: 11320520015<br>
            TEL: 0039/3336321195<br>
            maexportsrl@gmail.com<br>
            www.maexportsrl.com<br>
          </p>
        </div>
      </td>
    	<td align="right" width="50%">

         <p style="margin-bottom: 7px;"><b>Spettabile</b><br></p>
         <p style="line-height: 12px;">
          {{$cliente->denominazione}}<br>
          @if($cliente->partita_iva)
          {{$cliente->partita_iva}}<br>
          @endif
          {{$cliente->indirizzo}} {{$cliente->cap}} {{$cliente->provincia}}<br>
          {{$cliente->email}}<br>
          {{$cliente->telefono}}<br>
          {{$cliente->nazione}}<br>
        </p>
          

          @if($fattura->documento_di_trasporto)
            <b>LUOGO DI DESTINAZIONE</b><br>
            @if($fattura->luogo_destinazione)
              {{$fattura->luogo_destinazione}}
              @else
              {{$cliente->indirizzo}}<br>
              {{$cliente->cap}}<br>
              {{$cliente->provincia}}<br>
              {{$cliente->nazione}}<br>
              @if($cliente->note_extra)
                {{$cliente->note_extra}}<br>
              @endif
            @endif
          @endif
      </td>
    </tr>
</table>
 

@if($fattura->documento_di_trasporto && $fattura->casuale_trasporto)
<p><b>CASUALE DEL TRASPORTO</p></p>
<p>{{$fattura->casuale_trasporto}}</p>
@endif

  <table class="fattura" width="100%" style="margin-top:20px;margin-right:20px;">
    <thead>
      <tr>
        <th align="center" style="width:50px" class="title-small">CODICE</th>
        <th align="left" class="title-small">DESCRIZIONE</th>
        <th align="center" style="width:50px" class="title-small">PREZZO</th>
        <th align="center" style="width:50px" class="title-small">QUANTITÀ</th>
        <th align="center" style="width:50px" class="title-small">IMPORTO NETTO</th>
        <th align="center" style="width:50px" class="title-small">22% IVA</th>
        <th align="center" style="width:65px" class="title-small">IMPORTO TOTALE</th>
      </tr>
    </thead>
    <tbody>
      @php
          $importi = [];
          $totali = [];
          $ive = [];
      @endphp
    @foreach ($fattura->articoli as $art)
        <tr>
          <td>{{$art['codice']}}</td>
          <td align="left">{{$art['descrizione']}}</td>
          <td align="center">&#8364; {{$art['prezzo_netto']}}</td>
          <td align="center">{{$art['quantita']}} {{$art['unita_di_misura']}}</td>
          <td align="center">&#8364; {{$art['importo_netto']}}</td>
          <td align="center">&#8364; {{$art['iva']}}</td>
          <td align="center">&#8364; {{$art['importo_totale_articolo']}}</td>
        </tr>
        
    @endforeach
      </tbody>
  </table>
</div>

@if($fattura->note_documento)
<p>NOTE: {{$fattura->note_documento}}</p>
@endif

@if($fattura->tipo_documento == 'proforma')
<p>Il presente documento non costituisce fattura, che verrà emessa al momento del pagamento.</p>
@endif

@if($fattura->includi_metodo_pagamento && $fattura->metodo_pagamento && $fattura->tipo_documento == 'fattura')
<p>MODALITÀ DI PAGAMENTO: {{$fattura->metodo_pagamento}}</p>
@endif

@if(!$fattura->documento_di_trasporto)
<div class="bottom">
  <table class="bottom-table" style="width:100%">
    <tr>
      <table style="width:100%; margin-top:10px;">
        <tr>
          <td align="right">Imponibile</td>
          <td style="width: 120px; padding-right: 8px" align="right">&#8364; {{$fattura->totaleImponibile}}</td>
        </tr>
        <tr>
          <td align="right">Iva 22% su &#8364; {{$fattura->totaleImponibile}}</td>
          <td style="width: 120px; padding-right: 8px" align="right">&#8364; {{$fattura->totaleIva}}</td>
          
        </tr>
        
        @if($fattura->includi_marca_da_bollo == 'on')
        <tr>
          <td align="right">Non imponibile, bollo</td>
          <td style="width: 120px; padding-right: 8px" align="right">&#8364; {{$fattura->costo_bollo}}</td>
        </tr>
        @endif

        @php
            $totaleText = '';
            if($fattura->tipo_documento == 'preventivo'){
              $totaleText = 'Totale importo';
            } elseif($fattura->tipo_documento == 'ordine'){
              $totaleText = 'Totale importo';
            } elseif($fattura->tipo_documento == 'proforma'){
              $totaleText = 'Totale importo';
            } elseif ($fattura->tipo_documento == 'fattura') {
              $totaleText = 'Totale importo';
            }
        @endphp
        <tr>
          <td align="right" style="">{{$totaleText}}</td>
          <td style="padding-right: 8px; text-align: right; font-size: 2rem">&#8364; {{$fattura->totale}}</td>
        </tr>
      </table>
      
     </td>
  
    </tr>
  </table>
</div>
@endif


@if($fattura->documento_di_trasporto && $fattura->casuale_trasporto)
<table class="fattura" width="100%" style="margin-top:20px;">
  <thead>
    <tr>
      <th align="left">NUMERO DI COLLI</th>
      <th align="left">PESO</th>
      <th align="left">TRASPORTO</th>
      <th align="left">ANNOTAZIONI</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>{{$fattura->numero_colli_ddt}}</td>
      <td>{{$fattura->peso_ddt}}</td>
      <td>{{$fattura->trasporto_a_cura_di}}</td>
      <td>{{$fattura->annotazioni}}</td>
    </tr>
  </tbody>
</table>
@endif

@if($fattura->documento_di_trasporto)
<table width="100%" style="margin-top:20px;">
  <tr>
    <th>Data e firma mittente</th>
    <th>Data e firma corriere</th>
    <th>Data e firma destinatario</th>
  </tr>
</table>

@endif
</body>
</html>