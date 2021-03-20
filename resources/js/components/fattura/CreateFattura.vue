<template>
<form :action="route" method="POST">
    <input type="hidden" name="_token" :value="csrf">

  <!-- CLIENTE -->
  <div class="w-full bg-gray-100 rounded p-4 mb-4">
     <h1>CLIENTE</h1>
    <div class="flex flex-wrap m-6"> 
      <div>
          <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
              Cliente id
          </p>
          <input class="input-small" autocomplete="off" type="text" name="cliente_id" placeholder="cliente">
      </div>
    </div>
  </div> 

  <!-- DATI DOCUMENTO -->
  <div class="w-full bg-gray-100 rounded p-4 mb-4">
    <h1>DATI DOCUMENTO</h1>
    <div class="flex flex-wrap">

      <div class="m-6">
        <div>
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                numero
            </p>
            <input class="input-small w-36" autocomplete="off" type="text" name="numero">
        </div>
        <div class="mt-4">
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                data
            </p>
            <input class="input-small" autocomplete="off" type="date" name="data">
        </div>
      </div>

      <div class="m-6">
        <div>
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                lingua
            </p>
            <select autocomplete="off" class="input-small rounded-md border-gray-200" type="text" name="lingua">
              <option class="px-3" value="ita">italiano</option>
            </select>
        </div>
        <div class="mt-4">
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                valuta
            </p>
            <select autocomplete="off" class="input-small rounded-md border-gray-200" type="text" name="lingua">
              <option class="px-3" value="euro">euro</option>
            </select>
        </div>
      </div>

      <div class="m-6">
        <div>
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                oggetto (visibile)
            </p>
            <input autocomplete="off" class="input-small" type="text" name="oggetto_visibile" placeholder="Oggetto che apparirà nel documento">
        </div>
        <div class="mt-4">
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                oggetto interno (non visibile)
            </p>
            <input autocomplete="off" class="input-small" type="text" name="oggetto_interno" placeholder="Opzionale, per identificazione interna">
        </div>
      </div>
      <div class="m-6">
        <div>
          <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
              centro di ricavo
          </p>
          <input autocomplete="off" class="input-small" type="text" name="centro_di_ricavo" placeholder="Opzionale">
        </div>
      </div>
    </div>  
  </div>


  <!-- Contributi e Ritenute -->
  <div class="w-full bg-gray-100 rounded p-4 mb-4">
   <h1>CONTRIBUTI E RITENUTE</h1>
    <div class="m-6">
      <div>
        <div class="flex">
          <label class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
              <input type="checkbox" name="applica_rivalsa">
              applica cassa/rivalsa
          </label>
        </div>
        <div class="flex flex-wrap mx-6 my-3">
          <div>
              <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                  rivalsa inps
              </p>
              <div class="relative" >
              <input class="input-small w-16" type="text" name="rivalsa_inps" placeholder="0">
              <!-- <p class="absolute right-0 top-0 mt-2 mr-6 text-gray-800">%</p> -->
              </div>
          </div>
          <div class="ml-8">
              <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                  cassa prof.
              </p>
              <div class="relative" >
              <input class="input-small w-16" type="text" name="cassa_prof" placeholder="0">
              <!-- <p class="absolute right-0 top-0 mt-2 mr-6 text-gray-800">%</p> -->
              </div>
          </div>
        </div>
      </div>
      
      <div>
        <div class="flex">
          <label class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
              <input type="checkbox" name="applica_ritenuta">
             applica ritenuta
          </label>
        </div>
        <div class="flex flex-wrap mx-6 my-3">
          <div>
              <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                  ritenuta dacconto
              </p>
              <div class="relative" >
              <input class="input-small w-16" type="text" name="rit_dacconto" placeholder="0">
              <!-- <p class="absolute right-0 top-0 mt-2 mr-6 text-gray-800">%</p> -->
              </div>
          </div>
          <div>
              <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                  imponibile ritenuta
              </p>
              <div class="relative" >
              <input class="input-small w-16" type="text" name="imponibile_ritenuta" placeholder="0">
              <!-- <p class="absolute right-0 top-0 mt-2 mr-6 text-gray-800">%</p> -->
              </div>
          </div>
        </div>
      </div>

      <div>
        <div class="flex">
          <label class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
              <input type="checkbox" name="applica_altra_ritenuta">
             applica altra ritenuta
          </label>
        </div>
        <div class="mx-6 my-3">
            <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
                altra ritenuta
            </p>
            <div class="relative" >
            <input class="input-small w-16" type="text" name="altra_ritenuta" placeholder="0">
            <!-- <p class="absolute right-0 top-0 mt-2 mr-6 text-gray-800">%</p> -->
            </div>
        </div>
      </div>
    </div> 
  </div>

  <!-- OPZIONI AVANZATE -->
  <div class="w-full bg-gray-100 rounded p-4 mb-4">
     <h1>OPZIONI AVANZATE</h1>
      <div class="m-6">
      <div>
          <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
              metodo di pagamento
          </p>
          <select autocomplete="off" class="input-small rounded-md border-gray-200" type="text" name="metodo_pagamento">
            <option class="px-3" value="non_specificato">non specificato</option>
          </select>
      </div>

      <div class="mt-8"> 
        <div class="flex">
          <label class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
              <input type="checkbox" name="mostra_dettagli_pagamento">
              mostra dettagli pagamento
          </label>
        </div>
        <div class="flex">
          <label class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
              <input type="checkbox" name="documento_di_trasporto">
              documento di trasporto
          </label>
        </div>
        <div class="flex">
          <label class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
              <input type="checkbox" name="fatt_accompagnatoria">
              fattura accompagnatoria
          </label>
        </div>
        <div class="flex">
          <label class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
              <input type="checkbox" name="includi_marca_da_bollo">
              includi marca da_bollo
          </label>
        </div>
      </div>

      <div>
        <div class="mx-6 my-3">
          <p class="mt-4 pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
              costo bollo
          </p>
          <input autocomplete="off" class="input-small" type="text" name="costo_bollo" placeholder="2,00">
        </div>
      </div>
      <div class="flex">
        <label class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
            <input type="checkbox" name="applica_sconto_o_maggiorazione_sul_tot">
            applica sconto o maggiorazione sul totale da pagare
        </label>
      </div>
      <div class="flex mx-6 my-3">
        <label class="inline-flex items-center">
          <input type="radio" class="form-radio" name="tipo_sconto_o_maggiorazione_sul_tot" value="maggiorazione">
          <span class="ml-2">maggiorazione</span>
        </label>
        <label class="inline-flex items-center ml-6">
          <input type="radio" class="form-radio" name="tipo_sconto_o_maggiorazione_sul_tot" value="sconto">
          <span class="ml-2">sconto</span>
        </label>
        <div class="mx-6">
          <!-- <p class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
              maggiorazione
          </p> -->
          <input autocomplete="off" class="input-small w-16" type="text" name="val_sconto_o_maggiorazione_sul_tot" placeholder="0">
        </div>
      </div>
      <div class="flex">
        <label class="pb-1 text-left text-xs leading-4 font-medium text-gray-800 uppercase tracking-wider">
            <input type="checkbox" name="applica_split_payment">
            applica split payment
        </label>
      </div>
    </div> 
  </div>

    <button disabled class="mt-4 px-6 py-3 bg-blue-600 rounded-md text-white font-medium tracking-wide hover:bg-blue-300">
        Salva nuova fattura
    </button>
</form>
</template>

<script>
import { ref } from '@vue/reactivity'
export default {
  props: {
    route: {
      type: String,
      required: true
    }
  },
  setup(props){
    const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    const route = ref(props.route)
    return {route, csrf}
  }
}
</script>

<style>

</style>