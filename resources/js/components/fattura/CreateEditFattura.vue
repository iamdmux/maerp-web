<template>
<form ref="form" method="POST" class="mt-8">
<input type="hidden" name="_token" :value="csrf">
  <div v-if="mView == 'edit'">
      <input type="hidden" name="_method" :value="hiddenMethod">
  </div>

<div class="flex flex-wrap mb-2">
  <label class="p-3 mt-2 mr-2 bg-gray-100 rounded">preventivo
    <input @change="checkTipoDocumento" :disabled="mView == 'show'" v-model="tipo_documento" type="radio" name="tipo_documento" value="preventivo" checked>
  </label>
  <label class="p-3 mt-2 mr-2 bg-gray-100 rounded">ordine
    <input @change="checkTipoDocumento" :disabled="mView == 'show'" v-model="tipo_documento" type="radio" name="tipo_documento" value="ordine">
  </label>
  <label class="p-3 mt-2 mr-2 bg-gray-100 rounded">proforma
    <input @change="checkTipoDocumento" :disabled="mView == 'show'" v-model="tipo_documento" type="radio" name="tipo_documento" value="proforma">
  </label>
  <label v-if="canCreareFatture" class="p-3 mt-2 mr-2 bg-gray-100 rounded">ddt
    <input @change="checkTipoDocumento" :disabled="mView == 'show'" v-model="tipo_documento" type="radio" name="tipo_documento" value="ddt">
  </label>
  <label v-if="canCreareFatture" class="p-3 mt-2 mr-2 bg-gray-100 rounded">nota di credito
    <input @change="checkTipoDocumento" :disabled="mView == 'show'" v-model="tipo_documento" type="radio" name="tipo_documento" value="nota_di_credito">
  </label>
  <label v-if="canCreareFatture" class="p-3 mt-2 mr-2 bg-gray-100 rounded">fattura
    <input @change="checkTipoDocumento" :disabled="mView == 'show'" v-model="tipo_documento" type="radio" name="tipo_documento" value="fattura">
  </label>
</div>

<div v-if="canCreareFatture" class="my-5">
  <label class="p-3 bg-gray-100 rounded">fattura elettronica
    <input @change="checkTipoDocumento" :disabled="mView == 'show' || tipo_documento != 'fattura'" v-model="fattura_elettronica" type="checkbox" value="1" name="fattura_elettronica">
  </label>
</div>

<div class="mb-4 flex flex-wrap justify-end" style="max-width: 1113px;">
    <div v-if="mView == 'show'" class="p-2 ml-5 mt-2 bg-gray-300 rounded">
    <form class="flex" :action="fatturaConvertiUrl" method="POST">
    <input type="hidden" name="_token" :value="csrf">
    <input type="hidden" name="fattura_id" :value="fattura_id">
      <label class="text-sm pt-0.5">converti in:</label>
      <select name="converti" class="ml-2 h-6 py-0 text-sm">
        <option value="preventivo">preventivo</option>
        <option value="ordine">ordine</option>
        <option value="proforma">proforma</option>
        <option v-if="canCreareFatture" value="fattura">fattura</option>
      </select>
      <button onclick="return confirm('Vuoi creare una nuova copia del documento?')" class="ml-2 bg-white text-xs py-1 px-2 rounded">converti</button>
    </form>
  </div>

  <form v-if="mView == 'show'" :action="invioClientePdfUrl" method="POST">
      <div class="relative p-2 mt-2 ml-5 bg-gray-300 rounded">
        <input type="hidden" name="fattura_id" :value="fattura_id">
        <input type="hidden" name="_token" :value="csrf">
        <p v-if="testInviaPdf" class="absolute top-0 -mt-6">MOD. TEST</p>
        <button onclick="return confirm('Sei sicuro di inviare il pdf a questo cliente?')" target="_blank" href="#" class="flex text-sm">
        invia pdf
        <svg class="w-4 h-4 mx-2" style="margin-top:5px" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
        </button>
      </div>
  </form>

  <div v-if="mView == 'show'" class="p-2 ml-5 mt-2 bg-yellow-400 rounded">
    <a target="_blank" :href="pdfShow" class="flex text-sm">anteprima pdf
      <svg class="w-4 h-4 mx-2" style="margin-top:5px" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
    </a>
  </div>
</div>



<!-- <input type="hidden" v-model="tab_show_cliente" name="tab_show_cliente">
<input type="hidden" v-model="tab_show_dati_documento" name="tab_show_dati_documento">
<input type="hidden" v-model="tab_show_contributi_ritenute" name="tab_show_contributi_ritenute">
<input type="hidden" v-model="tab_show_opzioni_avanzate" name="tab_show_opzioni_avanzate">
<input type="hidden" v-model="tab_show_personalizzazione" name="tab_show_personalizzazione">
<input type="hidden" v-model="tab_show_note_doc" name="tab_show_note_doc">
<input type="hidden" v-model="quantiArticoli" name="quantiArticoli"> -->

<!-- wrapper 1 -->
<div class="flex flex-wrap" style="max-width: 1113px;">
  <!-- CLIENTE -->
  <div class="relative bg-gray-100 rounded p-4 mb-4 mr-4">
    <div class="flex justify-between mx-6">
      <h1><b>CLIENTE</b></h1>
      <button @click.prevent="tab_show_cliente = !tab_show_cliente" class="pl-4">
       <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
     </button>
    </div>
     
    <div v-show="tab_show_cliente">
      <div class="m-6"> 
        <div class="relative mb-2">
          <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
              ragione sociale / nome
          </p>
          <input :disabled="mView == 'show'" required v-model="denominazione" @input="searchCliente" class=" w-52" autocomplete="off" type="text" name="denominazione">
          <div v-if="filterCliente.length" class="z-10 text-sm p-4 bg-white rounded border border-gray-400">
            <div v-for="cliente in filterCliente" :key="cliente.id">
              <p @click="confermaCliente(cliente.id)" class="hover:bg-blue-400 cursor-pointer">{{cliente.denominazione}}</p> 
            </div>
          </div>
          <input type="hidden" name="cliente_id" :value="clienteId">
        </div>
        <div class="flex flex-wrap">
          <div class="mr-2">
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                indirizzo
            </p>
            <input disabled v-model="indirizzo" class=" w-36" autocomplete="off" type="text" name="indirizzo">
            <input :value="indirizzo" class=" w-36" autocomplete="off" type="hidden" name="indirizzo">
          </div>
          <div class="mr-2">
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                città
            </p>
            <input disabled v-model="citta" class=" w-36" autocomplete="off" type="text" name="citta">
            <input :value="citta" class=" w-36" autocomplete="off" type="hidden" name="citta">
          </div>
          <div class="mr-2">
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                cap
            </p>
            <input disabled v-model="cap" class=" w-36" autocomplete="off" type="text" name="cap">
            <input :value="cap" class=" w-36" autocomplete="off" type="hidden" name="cap">
          </div>
          <div class="mr-2">
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                provincia
            </p>
            <input disabled v-model="provincia" class=" w-36" autocomplete="off" type="text" name="provincia">
            <input :value="provincia" class=" w-36" autocomplete="off" type="hidden" name="provincia">
          </div>
        </div>
        <div class="flex flex-wrap mt-2">
          <div class="mr-2">
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                nazione
            </p>
            <input disabled v-model="nazione" class=" w-24" autocomplete="off" type="text" name="nazione">
            <input :value="nazione" class=" w-24" autocomplete="off" type="hidden" name="nazione">

          </div>
          <div class="mr-2">
            <!-- nazione_sigla -->
            <input disabled :value="nazione_sigla" class="text-center px-1 mt-5 w-10" autocomplete="off" type="text" name="nazione_sigla">
            <input :value="nazione_sigla" type="hidden" name="nazione_sigla">
          </div>

          <div class="mr-2">
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                partita iva
            </p>
            <input disabled v-model="partita_iva" class=" w-36" autocomplete="off" type="text" name="partita_iva">
            <input :value="partita_iva" class=" w-36" autocomplete="off" type="hidden" name="partita_iva">
          </div>
          <div class="mr-2">
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                codice fiscale
            </p>
            <input disabled v-model="codice_fiscale" class=" w-36" autocomplete="off" type="text" name="codice_fiscale">
            <input :value="codice_fiscale" class=" w-36" autocomplete="off" type="hidden" name="codice_fiscale">
          </div>
          <div class="mr-2">
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                email
            </p>
            <input disabled v-model="email" class=" w-36" autocomplete="off" type="text" name="email">
            <input :value="email" class=" w-36" autocomplete="off" type="hidden" name="email">
          </div>
        </div>
        <div v-if="ckeckViesMessage" class="text-xs mt-4">
          <p>{{ckeckViesMessage}}</p>
        </div>
      </div>
    </div>
  </div>

  <!-- DATI DOCUMENTO -->
  <div class="flex-1 relative bg-gray-100 rounded p-4 mb-4">
    <div class="flex justify-between mx-6">
      <h1><b>DATI DOCUMENTO</b></h1>
      <button @click.prevent="tab_show_dati_documento = !tab_show_dati_documento" class="pl-4">
       <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
     </button>
    </div>

    <div v-show="tab_show_dati_documento">
      <div class="flex flex-wrap">

        <div class="m-6">
          <div class="mb-2">
              <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                  numero
              </p>
              <input required :disabled="mView == 'show'" v-model="numero" class=" w-24" autocomplete="off" type="text" name="numero">
          </div>
          <div class="mb-2">
              <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                  data
              </p>
              <input :disabled="mView == 'show'" v-model="data" class="" type="date" name="data">
          </div>
        </div>

        <div class="m-6">
          <div class="mb-2">
              <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                  lingua
              </p>
              <select :disabled="mView == 'show'" v-model="lingua" class=" rounded-md border-gray-200" name="lingua">
                <option class="px-3" value="it">italiano</option>
              </select>
          </div>
          <div class="mb-2">
              <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                  valuta
              </p>
              <select :disabled="mView == 'show'" v-model="valuta" class=" rounded-md border-gray-200" name="valuta">
                <option class="px-3" value="euro">euro</option>
              </select>
          </div>
        </div>
      </div>
      <div class="m-6">
        <div>
          <p class="mt-4 pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
              note documento
          </p>
          <textarea :disabled="mView == 'show'" v-model="note_documento" rows="3" cols="35" class="text-sm" name="note_documento"></textarea>
        </div>
      </div>
    </div>
  </div>

    <!-- FATTURA ELETTRONICA -->
  <div v-show="fattura_elettronica" class="relative w-full bg-blue-200 rounded p-4 mb-4" style="max-width: 1113px;">
    <div class="flex justify-between mx-6">
      <h1><b>FATTURA ELETTRONICA</b></h1>
      <button @click.prevent="tab_show_fattura_elettronica = !tab_show_fattura_elettronica" class="pl-4">
       <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
     </button>
    </div>
    
    <div class="m-6" v-show="tab_show_fattura_elettronica">
      <div class="flex">
        <div class="mr-6">
          <div>
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                codice destinatario
            </p>
            <input :required="fattura_elettronica" :disabled="mView == 'show'" v-model="el_codice_destinatario" class=" w-36" autocomplete="off" type="text" name="el_codice_destinatario">
          </div>
          <div class="mt-2">
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                indirizzo PEC
            </p>
            <input :disabled="mView == 'show'" v-model="el_indirizzo_pec" class=" w-36" autocomplete="off" type="email" name="el_indirizzo_pec">
          </div>
        </div>

        <!-- <div class="mr-6">
          <div>
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                esigibilità iva
            </p>
            <select :disabled="mView == 'show'" v-model="el_esigibilita_iva" class=" rounded-md border-gray-200" name="el_esigibilita_iva">
              <option class="px-3" value="nd">non specificato</option>
            </select>
          </div>
          <div class="mt-2">
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                emesso in seguito a
            </p>
            <select :disabled="mView == 'show'" v-model="el_emesso_in_seguito_a" class=" rounded-md border-gray-200" name="el_emesso_in_seguito_a">
              <option class="px-3" value="nd">non specificato</option>
            </select>
          </div>
        </div> -->

        <div class="mr-6">
          <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
              metodo di pagamento
          </p>
          <select :disabled="mView == 'show'" v-model="el_metodo_pagamento" class="w-36 rounded-md border-gray-200" name="el_metodo_pagamento">
            <option class="px-3" value="contanti">contanti</option>
            <option class="px-3" value="assegno">assegno</option>
            <option class="px-3" value="assegno_circolare">assegno circolare</option>
            <option class="px-3" value="bonifico">bonifico</option>
            <option class="px-3" value="bollettino_bancario">bollettino bancario</option>
            <option class="px-3" value="carta_di_pagamento">carta di pagamento</option>
            <option class="px-3" value="bollettino_c_c">bollettino di c/c postale</option>
          </select>
          <div class="mt-2">
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                nome istituto di credito
            </p>
            <input :disabled="mView == 'show'" v-model="el_nome_istituto_di_credito" class=" w-36" autocomplete="off" type="text" placeholder="opzionale"  name="el_nome_istituto_di_credito">
          </div>
        </div>

        <div>
          <div>
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                IBAN
            </p>
            <input :disabled="mView == 'show'" v-model="el_iban" class=" w-36" autocomplete="off" type="text" placeholder="opzionale" name="el_iban">
          </div>
          <div class="mt-2">
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                nome beneficiario
            </p>
            <input :disabled="mView == 'show'" v-model="el_nome_beneficiario" class=" w-36" autocomplete="off" type="text" placeholder="opzionale" name="el_nome_beneficiario">
          </div>
        </div>
      </div>
    </div>
  </div>

</div>


  <!-- OPZIONI AVANZATE -->
  <div class="relative w-full bg-gray-100 rounded p-4 mb-4" style="max-width: 1113px;">
    <div class="flex justify-between mx-6">
      <h1><b>OPZIONI AVANZATE</b></h1>
      <button @click.prevent="tab_show_opzioni_avanzate = !tab_show_opzioni_avanzate" class="pl-4">
       <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
     </button>
    </div>

    <div v-show="tab_show_opzioni_avanzate">
      <div class="flex flex-wrap">
        <div class="m-6">
          <div class="mb-2"> 
            <div class="flex mb-2">
              <label @click="keepActiveDdt" v-if="tipo_documento == 'ddt'" class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                  <input :disabled="mView == 'show' || fattura_elettronica" v-model="documento_di_trasporto" type="checkbox" value="1" name="documento_di_trasporto">
                  documento di trasporto
              </label>
            </div>
            <div class="flex mb-1">
              <label class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                  <input :disabled="mView == 'show'" v-model="includi_marca_da_bollo" type="checkbox" value="1" name="includi_marca_da_bollo">
                  includi marca da_bollo
              </label>
            </div>
          </div>
          <div>
            <div v-show="includi_marca_da_bollo" class="mx-4 mb-4">
              <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                  costo bollo
              </p>
              <input :disabled="mView == 'show'" v-model="costo_bollo" autocomplete="off" class="" type="text" name="costo_bollo">
            </div>
          </div>
          <div class="flex mb-1">
            <label class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                <input :disabled="mView == 'show'" v-model="includi_metodo_pagamento" type="checkbox" value="1" name="includi_metodo_pagamento">
                includi metodo di pagamento
            </label>
          </div>
          <div v-show="includi_metodo_pagamento" class="mx-4 mb-4">
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                metodo di pagamento
            </p>
            <select :disabled="mView == 'show'" v-model="metodo_pagamento" class=" rounded-md border-gray-200" name="metodo_pagamento">
              <option class="px-3" value="bonifico">bonifico</option>
              <option class="px-3" value="contanti">contanti</option>
              <option class="px-3" value="assegno">assegno</option>
              <option class="px-3" value="assegno_circolare">assegno circolare</option>
              <option class="px-3" value="bollettino_bancario">bollettino bancario</option>
              <option class="px-3" value="carta_di_pagamento">carta di pagamento</option>
              <option class="px-3" value="bollettino_c_c">bollettino di c/c postale</option>
            </select>
          </div>
          <div class="flex mb-1">
            <label class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                <input :disabled="mView == 'show'" v-model="includi_note_pagamento" type="checkbox" value="1" name="includi_note_pagamento">
                includi note di pagamento
            </label>
          </div>
          <div v-show="includi_note_pagamento" class="mx-4 mb-4">
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                note pagamento
            </p>
           <textarea :disabled="mView == 'show'" v-model="note_pagamento" rows="3" cols="60" class="text-sm" name="note_pagamento"></textarea>
          </div>
            <!-- <div class="flex">
              <label class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                  <input type="checkbox" name="applica_sconto_o_maggiorazione_sul_tot">
                  applica sconto o maggiorazione sul totale da pagare
              </label>
            </div> -->
        </div>
        <div v-if="tipo_documento == 'ddt'" class="m-6">
          <div>
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
              DDT /fattura accompagnatoria
            </p>
            <div class="flex flex-wrap">
              <div>
                <div class="my-3">
                  <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                      numero ddt
                  </p>
                  <input required :disabled="mView == 'show'" v-model="numero_ddt" autocomplete="off" class="" type="text" name="numero_ddt">
                </div>
              </div>
              <div>
                <div class="my-3">
                  <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                      data ddt
                  </p>
                  <input :disabled="mView == 'show'" v-model="data_ddt" autocomplete="off" class="" type="date" name="data_ddt">
                </div>
              </div>
            </div>
            <div>
              <div class="mb-4">
                <p class="text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                    numero di colli
                </p>
                <input :disabled="mView == 'show'" v-model="numero_colli_ddt" autocomplete="off" class="" type="text" name="numero_colli_ddt" placeholder="es. 3 BANCALI">
              </div>
              <div class="mb-4">
                <p class="text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                    peso
                </p>
                <input :disabled="mView == 'show'" v-model="peso_ddt" autocomplete="off" class="" type="text" name="peso_ddt">
              </div>
            </div>

          </div>
        </div>
        <div v-if="tipo_documento == 'ddt'" class="m-6">
          <div class="flex flex-wrap">
            <div>
              <div class="mr-2 mb-2">
                <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                    casuale trasporto
                </p>
                <textarea :disabled="mView == 'show'" v-model="casuale_trasporto" rows="4" cols="15" autocomplete="off" class="text-sm" name="casuale_trasporto"></textarea>
              </div>
              <div class="mr-2 mb-2">
                <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                    trasporto a cura di
                </p>
                <textarea :disabled="mView == 'show'" v-model="trasporto_a_cura_di" rows="4" cols="15" autocomplete="off" class="text-sm" name="trasporto_a_cura_di"></textarea>
              </div>
            </div>
            <div>
              <div class="mr-2 mb-2">
                <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                    luogo di destinazione
                </p>
                <textarea :disabled="mView == 'show'" v-model="luogo_destinazione" rows="4" cols="15" autocomplete="off" class="text-sm" name="luogo_destinazione"></textarea>
              </div>
              <div>
                <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                    annotazioni
                </p>
                <textarea :disabled="mView == 'show'" v-model="annotazioni" rows="4" cols="15" autocomplete="off" class="text-sm" name="annotazioni"></textarea>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


<h1 class="mt-12 mb-6"><b>LISTA ARTICOLI</b></h1>

  <div style="max-width: 1113px;">
    <aggiungi-articolo v-for="numero in quantiArticoli"
    :numero-articolo="quantiArticoli"
    :mView="mView"
    :lotto_id="lotto_id_arr[numero-1]"
    :codice="codice_arr[numero-1]"
    :quantita="quantita_arr[numero-1]"
    :unita_di_misura="unita_di_misura_arr[numero-1]"
    :prezzo_netto="prezzo_netto_arr[numero-1]"
    :descrizione="descrizione_arr[numero-1]"
    :iva="iva_arr[numero-1]"
    :zero-percento-iva="zero_percento_iva_arr[numero-1]"
    :key="numero" 
    />
  </div>

  <div v-if="mView != 'show'" class="my-8 flex">
    <button @click.prevent="quantiArticoli++" class="px-3 py-2 bg-green-500 rounded-md text-white font-medium hover:bg-blue-400">
      aggiungi articolo
    </button>

    <button v-if="quantiArticoli > 1" @click.prevent="quantiArticoli--" class="ml-3 px-3 py-2 bg-blue-800 rounded-md text-white font-medium hover:bg-blue-400">
      rimuovi articolo
    </button>
  </div>


<div v-if="mView == 'create'" class="flex justify-between">
  <button @click="submitForm('savebutton')" class="mt-4 px-6 py-3 bg-blue-500 rounded-md text-white font-medium tracking-wide hover:bg-blue-400">
      salva fattura
  </button>
    <button @click="submitForm('pdf')" class="mt-4 px-6 py-3 bg-blue-500 rounded-md text-white font-medium tracking-wide hover:bg-blue-400">
      vedi fattura pdf
  </button>
</div>

<div v-if="mView == 'edit'" class="flex justify-between">
  <button @click.prevent="submitForm('savebutton')" class="mt-4 px-6 py-3 bg-blue-500 rounded-md text-white font-medium tracking-wide hover:bg-blue-400">
      modifica fattura
  </button>
  <button @click="submitForm('pdf')" class="mt-4 px-6 py-3 bg-blue-500 rounded-md text-white font-medium tracking-wide hover:bg-blue-400">
      vedi fattura pdf
  </button>
</div>

<!-- <div v-if="mView == 'show'">
    <button @click="submitForm('pdf')" class="mt-4 px-6 py-3 bg-blue-500 rounded-md text-white font-medium tracking-wide hover:bg-blue-400">
      vedi fattura pdf
  </button>
</div> -->



</form>
</template>

<script>
import { ref } from '@vue/reactivity'
// import { computed } from '@vue/runtime-core'
import AggiungiArticolo from './AggiungiArticolo.vue'
import { computed, onMounted } from '@vue/runtime-core'
// import storeArticoli from '../../composable/storeArticoli'
import moment from 'moment-timezone';


export default {
  props: {
    fatturaNextcounter:{
      required: false
    },
    mView:{
      type: String,
      required: true
    },
    canCreareFatture:{
      required: true
    },
    pdfUrl: {
      type: String,
      required: true
    },
    pdfShow:{
      required: false
    },
    formUrl: {
      type: String,
      required: false
    },
    invioClientePdfUrl:{
      required: false
    },
    old:{
      type: Object,
      required: false
    },
    testInviaPdf:{
      required: false
    },
    dataFattura:{ //per edit e show
      required: false
    },
    loadData:{
      required: false
    },
    articoliConv:{
      required: false
    },
    fatturaConvertiUrl:{
      required: false
    }
  },
  components: {
    AggiungiArticolo
  },
  created() {
      this.moment = moment;
      this.moment.locale('it');
      this.moment.tz.setDefault("Europe/Rome");
  },
  setup(props){
    const hiddenMethod = ref('patch')
    // props
    const mView = ref(props.mView)
    const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    const route = ref(props.route)
    const old = ref(props.old)
    
    const pdfShow = ref(props.pdfShow)
    const invioClientePdfUrl = ref(props.invioClientePdfUrl)
    const canCreareFatture = ref(props.canCreareFatture)
    const testInviaPdf = ref(props.testInviaPdf)
    const loadData = ref(props.loadData ? props.loadData : [])
    const articoliConv = props.articoliConv ? props.articoliConv : []
    const fatturaConvertiUrl = props.fatturaConvertiUrl ? props.fatturaConvertiUrl : ''

    const dateToday = new Date().toISOString().split("T")[0]

    const ckeckVies = ref('')

    const getRef = (key, defaultVal = '', type = null) => {

      let res

      // se è create
      if(mView.value == 'create'){
        return old.value[key] ? old.value[key] : defaultVal
      }
      else if(mView.value == 'show'){
        
        if(type == 'clienti'){
          res = loadData.value.cliente[key]
        }
        else if(type == 'articoli'){
          res = articoliConv[key]
        }
        else{
          res = loadData.value[key]
        }

      }
      else if(mView.value == 'edit'){

        if(type == 'clienti'){
          res = old.value[key] ? old.value[key] : loadData.value.cliente[key]
        }
        else if(type == 'articoli'){
          res = old.value[key] ? old.value[key] : articoliConv[key]
          // console.log(old.value[key], articoliConv[key])
        }
        else{
          res = old.value[key] ? old.value[key] : loadData.value[key]
        }
      }
        if(res){
          return res
        } else {
          return defaultVal
        }
    }

    const fattura_id = ref(loadData.value.id)

    const tipo_documento =                ref(getRef('tipo_documento', 'preventivo'))

    const tab_show_cliente =              ref(getRef('tab_show_cliente', true))
    const tab_show_dati_documento =       ref(getRef('tab_show_dati_documento', true))
    const tab_show_contributi_ritenute =  ref(getRef('tab_show_contributi_ritenute', false))
    const tab_show_opzioni_avanzate =     ref(getRef('tab_show_opzioni_avanzate', false))
    const tab_show_personalizzazione =    ref(getRef('tab_show_personalizzazione', false))
    const tab_show_note_doc =             ref(getRef('tab_show_note_doc', false))
    const fattura_elettronica =           ref(getRef('fattura_elettronica', false))
    const tab_show_fattura_elettronica =  ref(getRef('tab_show_fattura_elettronica', true))


    const listaClienti = ref({})

    const quantiArticoli = ref(Number( getRef('quantiArticoli', 1) ))
    if( mView.value != 'create' ){
      quantiArticoli.value = articoliConv['codice'].length
    }

    const clienteId =       ref(getRef('cliente_id', '')) // cliente id non è in 'clienti'
    const denominazione =   ref(getRef('denominazione', '', 'clienti'))
    const indirizzo =       ref(getRef('indirizzo', '', 'clienti'))
    const citta =           ref(getRef('citta', '', 'clienti'))
    const cap =             ref(getRef('cap', '', 'clienti'))
    const provincia =       ref(getRef('provincia', '', 'clienti'))
    const email =           ref(getRef('email', '', 'clienti'))
    const nazione =         ref(getRef('nazione', '', 'clienti'))
    const nazione_sigla =   ref(getRef('nazione_sigla', '', 'clienti'))
    const partita_iva =     ref(getRef('partita_iva', '', 'clienti'))
    const codice_fiscale =  ref(getRef('codice_fiscale', '', 'clienti'))

    const numero =          ref(getRef('numero', props.fatturaNextcounter))
    const data =            ref(parseDate(getRef('data', dateToday)))

    // patch data
    if(mView.value != 'create'){
      if(props.dataFattura){
        data.value = props.dataFattura.split(" ")[0]
      } else {
        data.value = ''
      }
    }
    

    const data_ddt =        ref(parseDate(getRef('data_ddt', dateToday, 'data')))
     // patch data
     if(mView.value != 'create'){
       if(loadData.value.data_ddt){
          data_ddt.value = loadData.value.data_ddt.split(" ")[0]
       }else {
         data_ddt.value = dateToday
       }
    }

    const numero_ddt =      ref(getRef('numero_ddt'))
    const includi_marca_da_bollo = ref(getRef('includi_marca_da_bollo', false))
    const costo_bollo =     ref(getRef('costo_bollo', 2.00))
    const includi_metodo_pagamento = ref(getRef('includi_metodo_pagamento', false))
    const includi_note_pagamento = ref(getRef('includi_note_pagamento', false))
    const note_pagamento =  ref(getRef('note_pagamento', false))
    const metodo_pagamento = ref(getRef('metodo_pagamento', 'bonifico'))
    const lingua =          ref(getRef('lingua', 'it'))
    const valuta =          ref(getRef('valuta', 'euro'))

    // ddt
    const documento_di_trasporto =  ref(getRef('documento_di_trasporto', false))
    const numero_colli_ddt =        ref(getRef('numero_colli_ddt'))
    const peso_ddt =                ref(getRef('peso_ddt'))
    const casuale_trasporto =       ref(getRef('casuale_trasporto'))
    const trasporto_a_cura_di =     ref(getRef('trasporto_a_cura_di'))
    const luogo_destinazione =      ref(getRef('luogo_destinazione'))
    const annotazioni =             ref(getRef('annotazioni'))

    // elettr
    const el_codice_destinatario =  ref(getRef('el_codice_destinatario'))
    const el_indirizzo_pec =        ref(getRef('el_indirizzo_pec'))
    const el_esigibilita_iva =      ref(getRef('el_esigibilita_iva', 'nd'))
    const el_emesso_in_seguito_a =  ref(getRef('el_emesso_in_seguito_a', 'nd'))
    const el_metodo_pagamento =     ref(getRef('el_metodo_pagamento', 'bonifico'))
    const el_nome_istituto_di_credito = ref(getRef('el_nome_istituto_di_credito'))
    const el_iban =                 ref(getRef('el_iban'))
    const el_nome_beneficiario =    ref(getRef('el_nome_beneficiario'))
    const note_documento =          ref(getRef('note_documento'))
 

    // articoli
    // const articoli = ref(getRef('articoli', [''], 'articoli'))
    const lotto_id_arr  =       ref(getRef('lotto_id', [''], 'articoli'))
    const codice_arr =          ref(getRef('codice', [''], 'articoli'))
    const quantita_arr =        ref(getRef('quantita', [''], 'articoli'))
    const unita_di_misura_arr = ref(getRef('unita_di_misura', [''], 'articoli'))
    const prezzo_netto_arr =    ref(getRef('prezzo_netto', [''], 'articoli'))
    const descrizione_arr =     ref(getRef('descrizione', [''], 'articoli'))
    const iva_arr =             ref(getRef('iva', [''], 'articoli'))
    const zero_percento_iva_arr =   ref(getRef('zero_percento_iva', [''], 'articoli'))

    function parseDate(data){
      // console.log(data)
      return moment(data).toISOString().split("T")[0]
    }

    const checkTipoDocumento = () => {
      if(tipo_documento.value != 'fattura'){
        fattura_elettronica.value = false
      }
      if(tipo_documento.value == 'ddt'){
        documento_di_trasporto.value = true
        tab_show_opzioni_avanzate.value = true
      }
      if(fattura_elettronica.value){
        documento_di_trasporto.value = false
      }
    }

    // form
    const form = ref(null)
    const submitForm = (type) => {

      if(type == 'pdfFromShow'){
        form.value.action = props.pdfUrl
        form.value.target = "viewpdf"
      }

      if(type == 'pdf'){

        if(mView.value == 'create'){
          form.value.target = "viewpdf"
        }

        if(mView.value == 'show' || mView.value == 'edit' ){
          hiddenMethod.value = ''
          form.value.target = "_blank"
        }

        form.value.action = props.pdfUrl
      }


      else if(type == 'savebutton'){

        if(mView.value == 'edit'){
          hiddenMethod.value = 'patch'
        }

        form.value.action = props.formUrl
        form.value.target = "_self"

        if (form.value.checkValidity()) {
           form.value.submit()
          // console.log(hiddenMethod.value, mView.value, form.value.action)
        } else {
          form.value.reportValidity()
          return
        }
      }
    }

    // cerca cliente
    const filterCliente = ref('')
    const searchCliente = () => {
      if(denominazione.value){
        axios.post('/api/fattura/clienti', {}, { params: { query_cliente: denominazione.value }})
        .then(res => {
          listaClienti.value = res.data
          ckeckVies.value = ''
        })
        .then( ()=>{
          filterCliente.value = listaClienti.value.filter(cliente => cliente.denominazione.toLowerCase().indexOf(denominazione.value.toLowerCase()) > -1)
        })
        .catch( e => console.log(e))
      }
    }

    const confermaCliente = (id) =>{
      let cliente = listaClienti.value.find( c => c.id == id)

      if(cliente){
        denominazione.value = cliente.denominazione
        indirizzo.value = cliente.indirizzo
        citta.value = cliente.citta
        cap.value = cliente.cap
        provincia.value = cliente.provincia
        email.value = cliente.email
        nazione.value = cliente.nazione
        nazione_sigla.value = cliente.nazione_sigla
        partita_iva.value = cliente.partita_iva
        codice_fiscale.value = cliente.codice_fiscale
        clienteId.value = cliente.id

        filterCliente.value = ''
        }

        checkVies(cliente.id)
    }

    const checkVies = (clienteId) => {
        axios.post(`/api/fattura/vies/${clienteId}`, {})
        .then( (res) => {
          console.log(res.data)
          ckeckVies.value = (res.data)
        })
    }

    const ckeckViesMessage = computed(() => {
      switch (ckeckVies.value) {
        case 0:
          return 'Vies: non valido'
          break;
        case 1:
          return 'Vies: valido'
          break;
        case 2:
          return 'non è stato possibilie verificare la p.iva'
          break;
        case 3:
          return 'Vies, mancano dei dati per la verifica p.iva'
          break;
        default:
          ''
          break;
      }
    })



    axios.defaults.withCredentials = true;
    
    const keepActiveDdt = () => {
      // vue mette false al posto di true?
      if(documento_di_trasporto.value){
        documento_di_trasporto.value  = false
      }
    }

    

    const onMountedFunc = () => {
      if(mView.value == 'show' && tipo_documento.value == 'ddt'){
        tab_show_opzioni_avanzate.value = true
      }
    }

  onMounted(onMountedFunc)

    return {
      fattura_id, hiddenMethod, testInviaPdf,
      // old_articoli

      lotto_id_arr, codice_arr, quantita_arr, unita_di_misura_arr, prezzo_netto_arr, descrizione_arr, iva_arr,
      //form
      form, submitForm, tipo_documento, pdfShow, checkTipoDocumento, invioClientePdfUrl,
      // basics_and_switch
      mView, canCreareFatture, route, csrf, tab_show_cliente, tab_show_fattura_elettronica, tab_show_dati_documento, tab_show_contributi_ritenute, tab_show_opzioni_avanzate, tab_show_personalizzazione, tab_show_note_doc,
      // methods/computed
      searchCliente, confermaCliente,keepActiveDdt,
      // otherObjects
      listaClienti, filterCliente, quantiArticoli,
      // vmodels
      clienteId, fattura_elettronica, denominazione, indirizzo, citta, data, numero, data_ddt, numero_ddt, cap, provincia, email, nazione, nazione_sigla, partita_iva,
      codice_fiscale, includi_marca_da_bollo, documento_di_trasporto, includi_metodo_pagamento, note_pagamento, includi_note_pagamento, el_indirizzo_pec, lingua, note_documento, valuta,
      el_emesso_in_seguito_a, el_esigibilita_iva, el_metodo_pagamento, el_nome_istituto_di_credito,el_iban,el_nome_beneficiario,
      metodo_pagamento, costo_bollo, numero_colli_ddt, peso_ddt, casuale_trasporto,trasporto_a_cura_di,luogo_destinazione,annotazioni,
      fatturaConvertiUrl, 
      // elettronica v-model
      el_codice_destinatario, el_indirizzo_pec, el_esigibilita_iva, el_emesso_in_seguito_a, el_metodo_pagamento, el_nome_istituto_di_credito, el_iban, el_nome_beneficiario,
      //articoli
      zero_percento_iva_arr, ckeckViesMessage
      // storeArticoli
    }
  }
}
</script>