<?php
namespace App\Fatturazione;


class FatturaArray{

  public function compilaFattura($fatt){

    $modalita_pagamento = '';
    if($fatt->el_metodo_pagamento == 'contanti'){
      $modalita_pagamento = 'MP01';
    } else if($fatt->el_metodo_pagamento == 'assegno'){
      $modalita_pagamento = 'MP02';
    } else if($fatt->el_metodo_pagamento == 'assegno_circolare'){
      $modalita_pagamento = 'MP03';
    } else if($fatt->el_metodo_pagamento == 'bonifico'){
      $modalita_pagamento = 'MP05';
    } else if($fatt->el_metodo_pagamento == 'bollettino_bancario'){
      $modalita_pagamento = 'MP07';
    } else if($fatt->el_metodo_pagamento == 'carta_di_pagamento'){
      $modalita_pagamento = 'MP08';
    } else if($fatt->el_metodo_pagamento == 'bollettino_c_c'){
      $modalita_pagamento = 'MP18';
    }

    $codice_destinatario = $fatt->el_codice_destinatario;
    if($codice_destinatario == ''){
      if($fatt->nazione_sigla == 'IT'){
        $codice_destinatario =  '0000000';
      } else {
        $codice_destinatario =  'XXXXXXX';
      }
    }

    $fattura = [
      'fattura_elettronica_header' => [
        'dati_trasmissione' => [
          'id_trasmittente' => [
            'id_paese' => 'IT',
            'id_codice' => '01641790702'
          ],
          'codice_destinatario' => $codice_destinatario,
          'contatti_trasmittente' => [
            'telefono' => null,
            'email' => null
          ],
          'pec_destinatario' => $fatt->el_indirizzo_pec,
        ],
        'cedente_prestatore' => [
          'dati_anagrafici' => [
            'id_fiscale_iva' => [
              'id_paese' => 'IT',
              'id_codice' => '11320520015'
            ],
            'codice_fiscale' => '11320520015',
            'anagrafica' => [
              'denominazione' => 'M&A EXPORT s.r.l',
              'nome' => null,
              'cognome' => null,
              'titolo' => null,
              'cod_eori' => null
            ],
            'albo_professionale' => null,
            'provincia_albo' => null,
            'numero_iscrizione_albo' => null, 
            'data_iscrizione_albo' => null, 
            'regime_fiscale' => 'RF01'                  
          ],
          'sede' => [
            'indirizzo' => 'Via Italia',
            'numero_civico' => '21',
            'cap' => '10035',
            'comune' => 'MAZZÉ',               // HO USATO LA É (accentata)
            'provincia' => 'TO',
            'nazione' => 'IT'
          ],
          // 'stabile_organizzazione' => [
          //   'indirizzo' => 'Via Italia',
          //   'numero_civico' => '21',
          //   'cap' => '10035',
          //   'comune' => 'MAZZÉ',
          //   'provincia' => 'TO',
          //   'nazione' => 'IT'
          // ],
          // 'iscrizione_rea' => [
          //   'ufficio' => null,
          //   'numero_rea' => null,
          //   'capitale_sociale' => null,
          //   'socio_unico' => null,
          //   'stato_liquidazione' => null
          // ],
          'contatti' => [
            'telefono' => null,
            'fax' => null,
            'email' => null
          ],
          'riferimento_amministrazione' => null
        ],
        // 'rappresentante_fiscale' => [
        //   'dati_anagrafici' => [
        //     'id_fiscale_iva' => [
        //       'id_paese' => null,
        //       'id_codice' => null
        //     ],
        //     'codice_fiscale' => null,
        //     'anagrafica' => [
        //       'denominazione' => null,
        //       'nome' => null,
        //       'cognome' => null,
        //       'titolo' => null,
        //       'cod_eori' => null
        //     ]
        //   ]
        // ],
        // cliente
        'cessionario_committente' => [
          'dati_anagrafici' => [
            'id_fiscale_iva' => [
              'id_paese' => $fatt->nazione_sigla,               // lista paesi IT
              'id_codice' => $fatt->partita_iva,                // IdCodice:numero di partita IVA del cessionario/committente.
            ],
            'codice_fiscale' => $fatt->codice_fiscale,          // codice fiscale
            'anagrafica' => [
              'denominazione' => $fatt->denominazione,          // ragione sociale
              'nome' => null,          // nome
              'cognome' => null,       // cognome
              'titolo' => null,  
              'cod_eori' => null
            ]
          ],
          // ************** inserisco dinamicamente sotto *********************
          // 'sede' => [
          //   'indirizzo' => $fatt->indirizzo,       // indirizzo
          //   'numero_civico' => null,               // civico
          //   'cap' => $fatt->cap,                   // cap
          //   'comune' => $fatt->citta,              // comune
          //   'provincia' => $fatt->provincia,       // provincia
          //   'nazione' => $fatt->nazione_sigla      // nazione IT ( è uguale a id_paese? )
          // ],
          // ********************************************************************
          // 'stabile_organizzazione' => [
          //   'indirizzo' => null,
          //   'numero_civico' => null,
          //   'cap' => null,
          //   'comune' => null,
          //   'provincia' => null,
          //   'nazione' => null
          // ],
          // 'rappresentante_fiscale' => [
          //   'id_fiscale_iva' => [
          //     'id_paese' => null,
          //     'id_codice' => null
          //   ],
          //   'denominazione' => null,
          //   'nome' => null,
          //   'cognome' => null
          // ]
        ],
        // 'terzo_intermediario_o_soggetto_emittente' => [
        //   'dati_anagrafici' => [
        //     'id_fiscale_iva' => [
        //       'id_paese' => null,
        //       'id_codice' => null
        //     ],
        //     'codice_fiscale' => null,
        //     'anagrafica' => [
        //       'denominazione' => null,
        //       'nome' => null,
        //       'cognome' => null,
        //       'titolo' => null,
        //       'cod_eori' => null
        //     ]
        //   ]
        // ],
        // 'soggetto_emittente' => 'TZ'
      ],
      'fattura_elettronica_body' => [
        [
          'dati_generali' => [
            'dati_generali_documento' => [
              'tipo_documento' => 'TD01',      // Fattura hardcoded
              'divisa' => 'EUR',               // valuta: mi serve la lista di questi campi
              'data' => (string)$fatt->data,          // data
              'numero' => $fatt->numero,                // numero
              // 'dati_ritenuta' => [
              //   [
              //     'tipo_ritenuta' => null,
              //     'importo_ritenuta' => null,
              //     'aliquota_ritenuta' => null,
              //     'causale_pagamento' => null
              //   ]
              // ],
              // ********************** creo in modo dinamico ************************
              // 'dati_bollo' => [
              //   'bollo_virtuale' => $fatt->includi_marca_da_bollo ? 'SI' : null,                   //  se c'è il bollo. valore ammesso [SI]
              //   'importo_bollo' => $fatt->includi_marca_da_bollo ? $fatt->costo_bollo : null    //  se c'è bollo, l'importo del bollo
              // ],
              // **********************************************************************
              // 'dati_cassa_previdenziale' => [
              //   [
              //     'tipo_cassa' => null,
              //     'al_cassa' => null,
              //     'importo_contributo_cassa' => null,
              //     'imponibile_cassa' => null,
              //     'aliquota_iva' => null,
              //     'ritenuta' => null,
              //     'natura' => null,
              //     'riferimento_amministrazione' => null
              //   ]
              // ],
              // 'sconto_maggiorazione' => [
              //   [
              //     'tipo' => null,
              //     'percentuale' => null,
              //     'importo' => null
              //   ]
              // ],
              'importo_totale_documento' => number_format($fatt->totale, 2), 
              'arrotondamento' => null,
              'causale' => [
                null
              ],
              'art73' => null
            ],
            // 'dati_ordine_acquisto' => [
            //   [
            //     'riferimento_numero_linea' => [
            //       0
            //     ],
            //     'id_documento' => null,
            //     'data' => null,
            //     'num_item' => null,
            //     'codice_commessa_convenzione' => null,
            //     'codice_cup' => null,
            //     'codice_cig' => null
            //   ]
            // ],
            // 'dati_contratto' => [
            //   [
            //     'riferimento_numero_linea' => [
            //       0
            //     ],
            //     'id_documento' => null,
            //     'data' => null,
            //     'num_item' => null,
            //     'codice_commessa_convenzione' => null,
            //     'codice_cup' => null,
            //     'codice_cig' => null
            //   ]
            // ],
            // 'dati_convenzione' => [
            //   [
            //     'riferimento_numero_linea' => [
            //       0
            //     ],
            //     'id_documento' => null,
            //     'data' => null,
            //     'num_item' => null,
            //     'codice_commessa_convenzione' => null,
            //     'codice_cup' => null,
            //     'codice_cig' => null
            //   ]
            // ],
            // 'dati_ricezione' => [
            //   [
            //     'riferimento_numero_linea' => [
            //       0
            //     ],
            //     'id_documento' => null,
            //     'data' => null,
            //     'num_item' => null,
            //     'codice_commessa_convenzione' => null,
            //     'codice_cup' => null,
            //     'codice_cig' => null
            //   ]
            // ],
            // 'dati_fatture_collegate' => [
            //   [
            //     'riferimento_numero_linea' => [
            //       0
            //     ],
            //     'id_documento' => null,
            //     'data' => null,
            //     'num_item' => null,
            //     'codice_commessa_convenzione' => null,
            //     'codice_cup' => null,
            //     'codice_cig' => null
            //   ]
            // ],
            // 'dati_sal' => [
            //   [
            //     'riferimento_fase' => 0
            //   ]
            // ],
            // 'dati_ddt' => [                          // per i DDT, meglio avere una fattura elettronica di esempio con questi dati
            //   [
            //     'numero_ddt' => null,                // numero DDT
            //     'data_ddt' => null,                  // data DDT
            //     'riferimento_numero_linea' => [
            //       null
            //     ]
            //   ]
            // ],
            // 'dati_trasporto' => [
            //   'dati_anagrafici_vettore' => [
            //     'id_fiscale_iva' => [
            //       'id_paese' => null,
            //       'id_codice' => null
            //     ],
            //     'codice_fiscale' => null,
            //     'anagrafica' => [
            //       'denominazione' => null,
            //       'nome' => null,
            //       'cognome' => null,
            //       'titolo' => null,
            //       'cod_eori' => null
            //     ],
            //     'numero_licenza_guida' => null 
            //   ],
            //   'mezzo_trasporto' => null,
            //   'causale_trasporto' => null,
            //   'numero_colli' => 0,
            //   'descrizione' => null,
            //   'unita_misura_peso' => null,
            //   'peso_lordo' => null,
            //   'peso_netto' => null,
            //   'data_ora_ritiro' => null,
            //   'data_inizio_trasporto' => null,
            //   'tipo_resa' => null,
            //   'indirizzo_resa' => [
            //     'indirizzo' => null,
            //     'numero_civico' => null,
            //     'cap' => null,
            //     'comune' => null,
            //     'provincia' => null,
            //     'nazione' => null
            //   ],
            //   'data_ora_consegna' => null 
            // ],
            // 'fattura_principale' => [
            //   'numero_fattura_principale' => null,
            //   'data_fattura_principale' => null
            // ]
          ],
          'dati_beni_servizi' => [
            // ********************** creo in modo dinamico ************************
            // 'dettaglio_linee' => [
            //   [
            //     'numero_linea' => array_keys($fatt->articoli)[0], // COMINCIA DA ZERO o UNO? (chiedere al ragazzo)
            //     'tipo_cessione_prestazione' => null,
            //     'codice_articolo' => [
            //       [
            //         'codice_tipo' => 'interno',                          
            //         'codice_valore' => $fatt->articoli[0]['codice']
            //       ]
            //     ],
            //     'descrizione' => $fatt->articoli[0]['descrizione'],             //descrizione
            //     'quantita' => number_format($fatt->articoli[0]['quantita'], 2),                //quantità
            //     'unita_misura' => $fatt->articoli[0]['unita_di_misura'],            //unita_misura
            //     'data_inizio_periodo' => null,
            //     'data_fine_periodo' => null,
            //     'prezzo_unitario' => $fatt->articoli[0]['importo_netto'],         //prezzo_unitario
            //     // 'sconto_maggiorazione' => [
            //     //   [
            //     //     'tipo' => null,
            //     //     'percentuale' => null,
            //     //     'importo' => null
            //     //   ]
            //     // ],
            //     'prezzo_totale' => $fatt->articoli[0]['importo_totale_articolo'],         // costo
            //     'aliquota_iva' => $fatt->articoli[0]['costo_iva_articolo'],                // '22.00' o '0' prezzo aliquota_iva
            //     'ritenuta' => null,
            //     'natura' => null,
            //     'riferimento_amministrazione' => null,
            //     // 'altri_dati_gestionali' => [
            //     //   [
            //     //     'tipo_dato' => null,
            //     //     'riferimento_testo' => null,
            //     //     'riferimento_numero' => null,
            //     //     'riferimento_data' => null
            //     //   ]
            //     // ]
            //   ]
            // ],
            // *********************************************************************
            // ********************** creo in modo dinamico ************************
            // 'dati_riepilogo' => [
            //   [
            //     'aliquota_iva' => '22.00',            // '22.00' . quale IVA ?
            //     'natura' => null,
            //     'spese_accessorie' => null,
            //     'arrotondamento' => null,
            //     'imponibile_importo' => number_format($fatt->totaleImponibile, 2),      // tot imponibile
            //     'imposta' => number_format($fatt->totaleIva, 2),                        // tot imposta
            //     'esigibilita_iva' => null,
            //     'riferimento_normativo' => null
            //   ]
            // ]
          ],
          // *********************************************************************
          // 'dati_veicoli' => [
          //   'data' => null,
          //   'totale_percorso' => null
          // ],
          'dati_pagamento' => [
            [
              'condizioni_pagamento' => 'TP02',      // mi serve questo dato? (nel XML è 'TP02') TP01 - pagamento a rate. TP02 - pagamento completo. TP03 -anticipo
              'dettaglio_pagamento' => [
                [
                  'beneficiario' => $fatt->el_nome_beneficiario,
                  'modalita_pagamento' => $modalita_pagamento,           // ok
                  'data_riferimento_termini_pagamento' => null,
                  'giorni_termini_pagamento' => 0,
                  'data_scadenza_pagamento' => null,
                  'importo_pagamento' => number_format($fatt->totale, 2),             // importo_pagamento es.36475.56
                  'cod_ufficio_postale' => null,
                  'cognome_quietanzante' => null,
                  'nome_quietanzante' => null,
                  'cf_quietanzante' => null,
                  'titolo_quietanzante' => null,
                  'istituto_finanziario' => $fatt->el_nome_istituto_di_credito,
                  'iban' => $fatt->el_iban,
                  'abi' => null,
                  'cab' => null,
                  'bic' => null,
                  'sconto_pagamento_anticipato' => null,
                  'data_limite_pagamento_anticipato' => null,
                  'penalita_pagamenti_ritardati' => null,
                  'data_decorrenza_penale' => null,
                  'codice_pagamento' => null
                ]
              ]
            ]
          ],
          // 'allegati' => [
          //   [
          //     'nome_attachment' => null,
          //     'algoritmo_compressione' => null,
          //     'formato_attachment' => null,
          //     'descrizione_attachment' => null,
          //     'attachment' => null
          //   ]
          // ]
        ]
      ]
    ];


    // sede
    $fattura['fattura_elettronica_header']['cessionario_committente']['sede'] = [
      'indirizzo' => $fatt->indirizzo,       // indirizzo
      'numero_civico' => null,               // civico
      'comune' => $fatt->citta,              // comune
      'provincia' => $fatt->provincia,       // provincia
      'nazione' => $fatt->nazione_sigla      // nazione IT ( è uguale a id_paese? )
    ];

    if($fatt->cap){
      $fattura['fattura_elettronica_header']['cessionario_committente']['sede']['cap'] = $fatt->cap;  // cap
    }
    


    // marca da bollo
    if($fatt->includi_marca_da_bollo && $fatt->costo_bollo):

      $fattura['fattura_elettronica_body'][0]['dati_generali']['dati_generali_documento']['dati_bollo'] = [
        'bollo_virtuale' => 'SI',                   //  se c'è il bollo. valore ammesso [SI]
        'importo_bollo' => $fatt->costo_bollo
      ];

    endif;

    // articoli
    $index = 0;
    foreach ($fatt->articoli as $articolo) {
      $fattura['fattura_elettronica_body'][0]['dati_beni_servizi']['dettaglio_linee'][0] =
        [
          'numero_linea' => $index, // COMINCIA DA ZERO o UNO? (chiedere al ragazzo)
          'tipo_cessione_prestazione' => null,
          'codice_articolo' => [
            [
              'codice_tipo' => 'interno',                         //(nel XML c'è 'INTERNO')
              'codice_valore' => $articolo['codice']     
            ]
          ],
          'descrizione' => $articolo['descrizione'],                //descrizione
          'quantita' => number_format($articolo['quantita'], 2),     //quantità
          'unita_misura' => $articolo['unita_di_misura'],            //unita_misura
          'data_inizio_periodo' => null,
          'data_fine_periodo' => null,
          'prezzo_unitario' => $articolo['importo_netto'],         //prezzo_unitario
          // 'sconto_maggiorazione' => [
          //   [
          //     'tipo' => null,
          //     'percentuale' => null,
          //     'importo' => null
          //   ]
          // ],
          'prezzo_totale' => $articolo['importo_totale_articolo'],         // costo
          'aliquota_iva' => $articolo['costo_iva_articolo'],                // '22.00' o '0' prezzo aliquota_iva
          'ritenuta' => null,
          'natura' => null,
          'riferimento_amministrazione' => null,
          // 'altri_dati_gestionali' => [
          //   [
          //     'tipo_dato' => null,
          //     'riferimento_testo' => null,
          //     'riferimento_numero' => null,
          //     'riferimento_data' => null
          //   ]
          // ]
      ];
      $index++;
    }

    // dati_riepilogo
    $articoliGroupBy = collect($fatt->articoli)->groupBy('iva');
    $index = 0;

    foreach ($articoliGroupBy as $keyIva => $articoliByIva) {
      $iva = $keyIva;
      $somma_imponibile_importo = 0;
      $somma_imposte = 0;

      foreach ($articoliByIva as $articolo) {
        $somma_imponibile_importo = ($somma_imponibile_importo + $articolo['importo_netto']);
        $somma_imposte = ($somma_imposte+$articolo['costo_iva_articolo']);
      }

      $fattura['fattura_elettronica_body'][0]['dati_beni_servizi']['dati_riepilogo'][$index] = 
        [
          'aliquota_iva' => number_format($iva, 2),         
          'natura' => null,
          'spese_accessorie' => null,
          'arrotondamento' => null,
          'imponibile_importo' => number_format($somma_imponibile_importo, 2),      // tot imponibile
          'imposta' => number_format($somma_imposte, 2),                        // tot imposta
          'esigibilita_iva' => null,
          'riferimento_normativo' => null
      ];
      $index++;
    }

    return $fattura;
  }
      
}
