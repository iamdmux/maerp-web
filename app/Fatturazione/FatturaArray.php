<?php
namespace App\Fatturazione;


class FatturaArray{

    // in questo array non trovo:
    // ProgressivoInvio, FormatoTrasmissione
    public $invoice = [
        'fattura_elettronica_header'=> [
          'dati_trasmissione'=> [
            'id_trasmittente'=> [
              'id_paese'=> 'IT',
              'id_codice'=> '01641790702'
            ],
            'codice_destinatario'=> '0000000',
            'contatti_trasmittente'=> [
              'telefono'=> '0874-60561',
              'email'=> 'string'                // MI MANCA QUSTO DATO
            ],
            'pec_destinatario'=> 'almasrl.fatture@pec.it'
          ],
          'cedente_prestatore'=> [
            'dati_anagrafici'=> [
              'id_fiscale_iva'=> [
                'id_paese'=> 'IT',
                'id_codice'=> '11320520015'
              ],
              'codice_fiscale'=> '11320520015',
              'anagrafica'=> [
                'denominazione'=> 'M&A EXPORT s.r.l',
                'nome'=> 'string',                  // MI MANCA QUSTO DATO
                'cognome'=> 'string',               // MI MANCA QUSTO DATO
                'titolo'=> 'string',                // MI MANCA QUSTO DATO
                'cod_eori'=> 'string'               // MI MANCA QUSTO DATO
              ],
              'albo_professionale'=> 'string',                   // MI MANCA QUSTO DATO
              'provincia_albo'=> 'string',                       // MI MANCA QUSTO DATO
              'numero_iscrizione_albo'=> 'string',               // MI MANCA QUSTO DATO
              'data_iscrizione_albo'=> '2021-04-01T16=>50=>42Z', // MI MANCA QUSTO DATO
              'regime_fiscale'=> 'RF01'                  
            ],
            'sede'=> [
              'indirizzo'=> 'Via Italia 21',
              'numero_civico'=> 'string',
              'cap'=> '10035',
              'comune'=> 'MAZZÉ',               // HO USATO LA É (accentata)
              'provincia'=> 'TO',
              'nazione'=> 'IT'
            ],
            'stabile_organizzazione'=> [
              'indirizzo'=> 'string',            // MI MANCA QUSTO DATO
              'numero_civico'=> 'string',        // MI MANCA QUSTO DATO
              'cap'=> 'string',                  // MI MANCA QUSTO DATO
              'comune'=> 'string',               // MI MANCA QUSTO DATO
              'provincia'=> 'string',            // MI MANCA QUSTO DATO
              'nazione'=> 'string'               // MI MANCA QUSTO DATO
            ],
            'iscrizione_rea'=> [
              'ufficio'=> 'string',               // MI MANCA QUSTO DATO
              'numero_rea'=> 'string',            // MI MANCA QUSTO DATO
              'capitale_sociale'=> 'string',      // MI MANCA QUSTO DATO
              'socio_unico'=> 'string',           // MI MANCA QUSTO DATO
              'stato_liquidazione'=> 'string'     // MI MANCA QUSTO DATO
            ],
            'contatti'=> [
              'telefono'=> 'string',        // MI MANCA QUSTO DATO
              'fax'=> 'string',             // MI MANCA QUSTO DATO
              'email'=> 'string'            // MI MANCA QUSTO DATO
            ],
            'riferimento_amministrazione'=> 'string'  // MI MANCA QUSTO DATO
          ],
          'rappresentante_fiscale'=> [
            'dati_anagrafici'=> [
              'id_fiscale_iva'=> [
                'id_paese'=> 'string',     // MI MANCA QUSTO DATO
                'id_codice'=> 'string'     // MI MANCA QUSTO DATO
              ],
              'codice_fiscale'=> 'string',  // MI MANCA QUSTO DATO
              'anagrafica'=> [
                'denominazione'=> 'string', // MI MANCA QUSTO DATO
                'nome'=> 'string',          // MI MANCA QUSTO DATO
                'cognome'=> 'string',       // MI MANCA QUSTO DATO
                'titolo'=> 'string',        // MI MANCA QUSTO DATO
                'cod_eori'=> 'string'       // MI MANCA QUSTO DATO
              ]
            ]
          ],
          'cessionario_committente'=> [ // cliente
            'dati_anagrafici'=> [
              'id_fiscale_iva'=> [
                'id_paese'=> 'string',
                'id_codice'=> 'string'
              ],
              'codice_fiscale'=> 'string',
              'anagrafica'=> [
                'denominazione'=> 'string',
                'nome'=> 'string',
                'cognome'=> 'string',
                'titolo'=> 'string',
                'cod_eori'=> 'string'
              ]
            ],
            'sede'=> [
              'indirizzo'=> 'string',
              'numero_civico'=> 'string',
              'cap'=> 'string',
              'comune'=> 'string',
              'provincia'=> 'string',
              'nazione'=> 'string'
            ],
            'stabile_organizzazione'=> [
              'indirizzo'=> 'string',
              'numero_civico'=> 'string',
              'cap'=> 'string',
              'comune'=> 'string',
              'provincia'=> 'string',
              'nazione'=> 'string'
            ],
            'rappresentante_fiscale'=> [
              'id_fiscale_iva'=> [
                'id_paese'=> 'string',
                'id_codice'=> 'string'
              ],
              'denominazione'=> 'string',
              'nome'=> 'string',
              'cognome'=> 'string'
            ]
          ],
          'terzo_intermediario_o_soggetto_emittente'=> [
            'dati_anagrafici'=> [
              'id_fiscale_iva'=> [
                'id_paese'=> 'string',
                'id_codice'=> 'string'
              ],
              'codice_fiscale'=> 'string',
              'anagrafica'=> [
                'denominazione'=> 'string',
                'nome'=> 'string',
                'cognome'=> 'string',
                'titolo'=> 'string',
                'cod_eori'=> 'string'
              ]
            ]
          ],
          'soggetto_emittente'=> 'string'
        ],
        'fattura_elettronica_body'=> [
          [
            'dati_generali'=> [
              'dati_generali_documento'=> [
                'tipo_documento'=> 'string',
                'divisa'=> 'string',
                'data'=> '2021-04-01T16=>50=>42Z',
                'numero'=> 'string',
                'dati_ritenuta'=> [
                  [
                    'tipo_ritenuta'=> 'string',
                    'importo_ritenuta'=> 'string',
                    'aliquota_ritenuta'=> 'string',
                    'causale_pagamento'=> 'string'
                  ]
                ],
                'dati_bollo'=> [
                  'bollo_virtuale'=> 'string',
                  'importo_bollo'=> 'string'
                ],
                'dati_cassa_previdenziale'=> [
                  [
                    'tipo_cassa'=> 'string',
                    'al_cassa'=> 'string',
                    'importo_contributo_cassa'=> 'string',
                    'imponibile_cassa'=> 'string',
                    'aliquota_iva'=> 'string',
                    'ritenuta'=> 'string',
                    'natura'=> 'string',
                    'riferimento_amministrazione'=> 'string'
                  ]
                ],
                'sconto_maggiorazione'=> [
                  [
                    'tipo'=> 'string',
                    'percentuale'=> 'string',
                    'importo'=> 'string'
                  ]
                ],
                'importo_totale_documento'=> 'string',
                'arrotondamento'=> 'string',
                'causale'=> [
                  'string'
                ],
                'art73'=> 'string'
              ],
              'dati_ordine_acquisto'=> [
                [
                  'riferimento_numero_linea'=> [
                    0
                  ],
                  'id_documento'=> 'string',
                  'data'=> '2021-04-01T16=>50=>42Z',
                  'num_item'=> 'string',
                  'codice_commessa_convenzione'=> 'string',
                  'codice_cup'=> 'string',
                  'codice_cig'=> 'string'
                ]
              ],
              'dati_contratto'=> [
                [
                  'riferimento_numero_linea'=> [
                    0
                  ],
                  'id_documento'=> 'string',
                  'data'=> '2021-04-01T16=>50=>42Z',
                  'num_item'=> 'string',
                  'codice_commessa_convenzione'=> 'string',
                  'codice_cup'=> 'string',
                  'codice_cig'=> 'string'
                ]
              ],
              'dati_convenzione'=> [
                [
                  'riferimento_numero_linea'=> [
                    0
                  ],
                  'id_documento'=> 'string',
                  'data'=> '2021-04-01T16=>50=>42Z',
                  'num_item'=> 'string',
                  'codice_commessa_convenzione'=> 'string',
                  'codice_cup'=> 'string',
                  'codice_cig'=> 'string'
                ]
              ],
              'dati_ricezione'=> [
                [
                  'riferimento_numero_linea'=> [
                    0
                  ],
                  'id_documento'=> 'string',
                  'data'=> '2021-04-01T16=>50=>42Z',
                  'num_item'=> 'string',
                  'codice_commessa_convenzione'=> 'string',
                  'codice_cup'=> 'string',
                  'codice_cig'=> 'string'
                ]
              ],
              'dati_fatture_collegate'=> [
                [
                  'riferimento_numero_linea'=> [
                    0
                  ],
                  'id_documento'=> 'string',
                  'data'=> '2021-04-01T16=>50=>42Z',
                  'num_item'=> 'string',
                  'codice_commessa_convenzione'=> 'string',
                  'codice_cup'=> 'string',
                  'codice_cig'=> 'string'
                ]
              ],
              'dati_sal'=> [
                [
                  'riferimento_fase'=> 0
                ]
              ],
              'dati_ddt'=> [
                [
                  'numero_ddt'=> 'string',
                  'data_ddt'=> '2021-04-01T16=>50=>42Z',
                  'riferimento_numero_linea'=> [
                    'string'
                  ]
                ]
              ],
              'dati_trasporto'=> [
                'dati_anagrafici_vettore'=> [
                  'id_fiscale_iva'=> [
                    'id_paese'=> 'string',
                    'id_codice'=> 'string'
                  ],
                  'codice_fiscale'=> 'string',
                  'anagrafica'=> [
                    'denominazione'=> 'string',
                    'nome'=> 'string',
                    'cognome'=> 'string',
                    'titolo'=> 'string',
                    'cod_eori'=> 'string'
                  ],
                  'numero_licenza_guida'=> 'string'
                ],
                'mezzo_trasporto'=> 'string',
                'causale_trasporto'=> 'string',
                'numero_colli'=> 0,
                'descrizione'=> 'string',
                'unita_misura_peso'=> 'string',
                'peso_lordo'=> 'string',
                'peso_netto'=> 'string',
                'data_ora_ritiro'=> '2021-04-01T16=>50=>42Z',
                'data_inizio_trasporto'=> '2021-04-01T16=>50=>42Z',
                'tipo_resa'=> 'string',
                'indirizzo_resa'=> [
                  'indirizzo'=> 'string',
                  'numero_civico'=> 'string',
                  'cap'=> 'string',
                  'comune'=> 'string',
                  'provincia'=> 'string',
                  'nazione'=> 'string'
                ],
                'data_ora_consegna'=> '2021-04-01T16=>50=>42Z'
              ],
              'fattura_principale'=> [
                'numero_fattura_principale'=> 'string',
                'data_fattura_principale'=> '2021-04-01T16=>50=>42Z'
              ]
            ],
            'dati_beni_servizi'=> [
              'dettaglio_linee'=> [
                [
                  'numero_linea'=> 0,
                  'tipo_cessione_prestazione'=> 'string',
                  'codice_articolo'=> [
                    [
                      'codice_tipo'=> 'string',
                      'codice_valore'=> 'string'
                    ]
                  ],
                  'descrizione'=> 'string',
                  'quantita'=> 'string',
                  'unita_misura'=> 'string',
                  'data_inizio_periodo'=> '2021-04-01T16=>50=>42Z',
                  'data_fine_periodo'=> '2021-04-01T16=>50=>42Z',
                  'prezzo_unitario'=> 'string',
                  'sconto_maggiorazione'=> [
                    [
                      'tipo'=> 'string',
                      'percentuale'=> 'string',
                      'importo'=> 'string'
                    ]
                  ],
                  'prezzo_totale'=> 'string',
                  'aliquota_iva'=> 'string',
                  'ritenuta'=> 'string',
                  'natura'=> 'string',
                  'riferimento_amministrazione'=> 'string',
                  'altri_dati_gestionali'=> [
                    [
                      'tipo_dato'=> 'string',
                      'riferimento_testo'=> 'string',
                      'riferimento_numero'=> 'string',
                      'riferimento_data'=> '2021-04-01T16=>50=>42Z'
                    ]
                  ]
                ]
              ],
              'dati_riepilogo'=> [
                [
                  'aliquota_iva'=> 'string',
                  'natura'=> 'string',
                  'spese_accessorie'=> 'string',
                  'arrotondamento'=> 'string',
                  'imponibile_importo'=> 'string',
                  'imposta'=> 'string',
                  'esigibilita_iva'=> 'string',
                  'riferimento_normativo'=> 'string'
                ]
              ]
            ],
            'dati_veicoli'=> [
              'data'=> '2021-04-01T16=>50=>42Z',
              'totale_percorso'=> 'string'
            ],
            'dati_pagamento'=> [
              [
                'condizioni_pagamento'=> 'string',
                'dettaglio_pagamento'=> [
                  [
                    'beneficiario'=> 'string',
                    'modalita_pagamento'=> 'string',
                    'data_riferimento_termini_pagamento'=> '2021-04-01T16=>50=>42Z',
                    'giorni_termini_pagamento'=> 0,
                    'data_scadenza_pagamento'=> '2021-04-01T16=>50=>42Z',
                    'importo_pagamento'=> 'string',
                    'cod_ufficio_postale'=> 'string',
                    'cognome_quietanzante'=> 'string',
                    'nome_quietanzante'=> 'string',
                    'cf_quietanzante'=> 'string',
                    'titolo_quietanzante'=> 'string',
                    'istituto_finanziario'=> 'string',
                    'iban'=> 'string',
                    'abi'=> 'string',
                    'cab'=> 'string',
                    'bic'=> 'string',
                    'sconto_pagamento_anticipato'=> 'string',
                    'data_limite_pagamento_anticipato'=> '2021-04-01T16=>50=>42Z',
                    'penalita_pagamenti_ritardati'=> 'string',
                    'data_decorrenza_penale'=> '2021-04-01T16=>50=>42Z',
                    'codice_pagamento'=> 'string'
                  ]
                ]
              ]
            ],
            'allegati'=> [
              [
                'nome_attachment'=> 'string',
                'algoritmo_compressione'=> 'string',
                'formato_attachment'=> 'string',
                'descrizione_attachment'=> 'string',
                'attachment'=> null
              ]
            ]
          ]
        ]
    ];

    // $invoicesimplified = [
    //     'fattura_elettronica_header' => [
    //     'dati_trasmissione'=> [
    //         'codice_destinatario'=> 'ABCDEFG'
    //     ],
    //     'cedente_prestatore'=> [
    //         'id_fiscale_iva'=> [
    //             'id_paese'=> 'IT',
    //             'id_codice'=> '12345678901'
    //         ],
    //         'sede'=> [
    //             'indirizzo'=> 'address string',
    //             'cap'=> '12345',
    //             'comune'=> 'city string',
    //             'nazione'=> 'IT'
    //         ],
    //         'regime_fiscale'=> 'RF01'
    //     ],
    //     'cessionario_committente'=> [
    //         'identificativi_fiscali'=> [
    //             'codice_fiscale'=> 'ABSDVFCNSHBGAFTS'
    //         ]
    //     ]
    // ],
    // 'fattura_elettronica_body'=> [[
    //     'dati_generali'=> [
    //         'dati_generali_documento'=> [
    //             'tipo_documento'=> 'TD07',
    //             'divisa'=> 'EUR',
    //             'data'=> '2020-07-01',
    //             'numero'=> '111'
    //         ]
    //     ],
    //     'dati_beni_servizi'=> [[
    //         'descrizione'=> 'goods description',
    //         'importo'=> '100',
    //         'dati_iva'=> [
    //             'imposta'=> '22'
    //         ]
    //     ]]
    // ]]
    // ]
}