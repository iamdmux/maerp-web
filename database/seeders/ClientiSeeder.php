<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientiSeeder extends Seeder
{
    public function run()
    {
        DB::table('clienti')->insert(
            [
                'user_id' => 1, 
                'denominazione' => 'Mario Rossi',
                'codice_sdi' => 'abc',
                'tipologia' => 'azienda',
                'referente' => 'Gennaro Baldo',
                'paese' => 'IT',
                'indirizzo' => 'via Campostrini',
                'citta' => 'Torino',
                'cap' => '38100',
                'provincia' => 'Torino',
                'note_indirizzo' => 'note',
                'email' => 'emailazienda@libero.it',
                'pec' => 'emailazienda@tiscali.it',
                'telefono' => '3400055858',
                'note_extra' => '',
                'aliquota_iva' => '22',
                'termini_pagamento' => '4',
                'termini_tipo' => 'ggfinemese',
                'metodo_pagamento_predef' => 'vaglia postale',
                'iban' => '123456789',
                // 'fax' => '',
                'indirizzo_spedizione' => 'Via del Tesoro, 18',
            ],
        );

        DB::table('clienti')->insert(
            [
                'user_id' => 2, 
                'denominazione' => 'Mario Rossi',
                'codice_sdi' => 'abc',
                'tipologia' => 'azienda',
                'referente' => 'Gennaro Baldo',
                'paese' => 'IT',
                'indirizzo' => 'via Campostrini',
                'citta' => 'Torino',
                'cap' => '38100',
                'provincia' => 'Torino',
                'note_indirizzo' => 'note',
                'email' => 'emailazienda@libero.it',
                'pec' => 'emailazienda@tiscali.it',
                'telefono' => '3400055858',
                'note_extra' => '',
                'aliquota_iva' => '22',
                'termini_pagamento' => '4',
                'termini_tipo' => 'ggfinemese',
                'metodo_pagamento_predef' => 'vaglia postale',
                'iban' => '123456789',
                // 'fax' => '',
                'indirizzo_spedizione' => 'Via del Tesoro, 18',
            ],
        );
    }
}
