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
              'telefono'=> '0874-60561'
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
                'denominazione'=> 'M&A EXPORT s.r.l'
              ],
              'regime_fiscale'=> 'RF01'                  
            ],
            'sede'=> [
              'indirizzo'=> 'Via Italia 21',
              'numero_civico'=> 'string',
              'cap'=> '10035',
              'comune'=> 'MAZZÉ',
              'provincia'=> 'TO',
              'nazione'=> 'IT'
            ]
          ],
          'cessionario_committente'=> [
            'dati_anagrafici'=> [
              'id_fiscale_iva'=> [
                'id_paese'=> 'string',
                'id_codice'=> 'string'
              ],
              'codice_fiscale'=> 'string',
              'anagrafica'=> [
                'denominazione'=> 'string',
              ]
            ],
            'sede'=> [
              'indirizzo'=> 'string',
              'numero_civico'=> 'string',
              'cap'=> 'string',
              'comune'=> 'string',
              'provincia'=> 'string',
              'nazione'=> 'string'
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
                'tipo_documento'=> 'TD01',
                'divisa'=> 'EUR',
                'data'=> '2021-03-19',
                'numero'=> '250',
                'importo_totale_documento'=> 'string'
              ],
            'dati_beni_servizi'=> [
              'dettaglio_linee'=> [
                [
                  'numero_linea'=> 1,
                  'codice_articolo'=> [
                    [
                      'codice_tipo'=> 'INTERNO',
                      'codice_valore'=> '93.01'
                    ]
                  ],
                  'descrizione'=> 'STOCK ABBIGLIAMENTO DONDUP',
                  'quantita'=> '2266.00',
                  'unita_misura'=> 'pezzi',
                  'prezzo_unitario'=> '13.00',
                  'prezzo_totale'=> '29458.00',
                  'aliquota_iva'=> '22.00'
                ]
              ],
              'dettaglio_linee'=> [
                [
                  'numero_linea'=> 2,
                  'codice_articolo'=> [
                    [
                      'codice_tipo'=> 'INTERNO',
                      'codice_valore'=> '11.00'
                    ]
                  ],
                  'descrizione'=> 'TRASPORTO',
                  'quantita'=> '11.00',
                  'unita_misura'=> 'BANCALI',
                  'prezzo_unitario'=> '40.00',
                  'prezzo_totale'=> '440.00',
                  'aliquota_iva'=> '22.00'
                ]
              ],
              'dati_riepilogo'=> [
                [
                  'aliquota_iva'=> '22.00',
                  'imponibile_importo'=> '29898.00',
                  'imposta'=> '6577.56'
                ]
              ]
            ],
            'dati_veicoli'=> [
              'data'=> '2021-04-01T16=>50=>42Z',
              'totale_percorso'=> 'string'
            ],
            'dati_pagamento'=> [
              [
                'condizioni_pagamento'=> 'TP02',
                'dettaglio_pagamento'=> [
                  [
                    'modalita_pagamento'=> 'MP02',
                    'data_scadenza_pagamento'=> '2021-04-02',
                    'importo_pagamento'=> '36475.56',
                  ]
                ]
              ]
            ]
          ]
        ]
    ]
  ];
}