<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Fattura</title>
<script>
  this.name = "viewpdf";
</script>

<style type="text/css">
    * {
        font-family: Verdana, Arial, sans-serif;
        font-size: 0.8rem;
    }
    .gray {
        background-color: lightgray
    }
    table{
        border-collapse: collapse;
    }
    .fattura{
      border-bottom: 1px solid rgba(0,0,0,0.2);
    }
    .fattura thead tr th{
        border-bottom: 1px solid rgba(0,0,0,0.2);
        border-top: 1px solid rgba(0,0,0,0.2);
    }
    .fattura th, .fattura td {
        border-left: 1px solid rgba(0,0,0,0.2);
        border-right: 1px solid rgba(0,0,0,0.2);
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
      font-size: 0.65rem;
    }
    .bottom-table{
      width:100%;
      /* position:absolute;
      bottom:100px; */
      border-top: 1px solid rgba(0,0,0,0.2);
      border-bottom: 1px solid rgba(0,0,0,0.2);
    }
    
    .bottom-table td:first-child{
      border-right: 1px solid rgba(0,0,0,0.2);
    }
    .top {
      height: 900px;
      max-height: 900px;
    }
    .bottom-left-table td, .bottom-left-table td *{
      vertical-align: top;
    }
    
    

</style>

</head>
<body>
  <div class="top">
  <p style="text-align:right; font-size:14px; margin:0;">FATTURA nr. 1/2021 del 19/03/2021</p>
  <table width="100%">
    <tr>
    	<td align="left" width="50%">
        <div>
          <img src="https://via.placeholder.com/75" alt="M&A EXPORT" />
        </div>
        <div style="margin-top:20px;">
          <strong>M&A EXPORT s.r.l</strong><br>
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
        </div>
      </td>
    	<td align="right" width="50%">

          DESTINATARIO<br>
          <b>{{$cliente->denominazione}}</b><br>
          @if($cliente->partita_iva)
          {{$cliente->partita_iva}}<br>
          @endif
          {{$cliente->indirizzo}} {{$cliente->cap}} {{$cliente->provincia}}<br>
          {{$cliente->email}}<br>
          {{$cliente->telefono}}

      </td>
    </tr>
</table>
 

  <br>

  <table class="fattura" width="100%" style="margin-top:20px;">
    <thead>
      <tr>
        <th align="center" style="width:35px" class="title-small">CODICE</th>
        <th align="left" class="title-small">DESCRIZIONE</th>
        <th align="center" style="width:35px"class="title-small">QUANTITÀ</th>
        <th align="center" style="width:35px"class="title-small">SCONTO</th>
        <th align="center" style="width:35px"class="title-small">IMPORTO</th>
        <th align="center" style="width:35px"class="title-small">% IVA</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>abcdef</td>
        <td align="left">descrizione prodotto lorem ispum dolorem.</td>
        <td align="center">2</td>
        <td align="center">105.00</td>
        <td align="center">105.00</td>
        <td align="center">1400.00</td>
      </tr>
      <tr>
          <td>abcdef</td>
          <td align="left">descrizione prodotto lorem ispum dolorem</td>
          <td align="center">2</td>
          <td align="center">105.00</td>
          <td align="center">105.00</td>
          <td align="center">1400.00</td>
      </tr>
      <tr>
          <td>abcdef</td>
          <td align="left">descrizione prodotto lorem ispum dolorem</td>
          <td align="center">1</td>
          <td align="center">130.00</td>
          <td align="center">130.00</td>
          <td align="center">1400.00</td>
      </tr>
    </tbody>
  </table>
</div>

<div class="bottom">
  <table class="bottom-table" style="width:100%">
    <tr>
      <td style="vertical-align:top;">
      <table style="width:100%">
        <tr>
          <td class="title-small" style="width:65%; padding-top: 8px;">RIEPILOGO IVA</td>
          <td align="right" style="padding-top: 8px;"class="title-small">IMPONIBILE</td>
          <td align="right" style="padding-top: 8px; padding-right: 8px;"class="title-small">IMPOSTE</td>
        </tr>
        <tr>
          <td>20%</td>
          <td align="right">78,00</td>
          <td align="right" style="padding-right: 8px;">€ 15,60</td>
        </tr>
        </table>
      </td>

     <td style="vertical-align:baseline;">
      <table style="width:100%; margin-top:20px;">
        <tr>
          <td align="right">Imponibile</td>
          <td align="right">€ 78,00</td>
        </tr>
        <tr>
          <td align="right">Totale IVA</td>
          <td align="right">€ 15,60</td>
        </tr>
        <tr>
          <td align="right">Non imponibile</td>
          <td align="right">€ 2,00</td>
        </tr>
      </table>
      <p style="margin:0; text-align: right; font-size: 3rem">€ 95,60</p>
     </td>
  
    </tr>
  </table>
</div>

</body>
</html>