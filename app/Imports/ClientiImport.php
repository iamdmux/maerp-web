<?php

namespace App\Imports;

use App\Models\Vendite\Cliente;
use Maatwebsite\Excel\Concerns\ToModel;

class ClientiImport implements ToModel
{
    private $rows = 0;


    public function model(array $row)
    {
        ++$this->rows;

        if($this->rows > 1 && $this->rows < 1573){

            return new Cliente([
              'denominazione' => preg_replace('/\s+/', ' ', $row[0]),
              'user_id' => $this->convertToUserId($row[1]),
              'indirizzo' => $row[2],
              'citta' => $row[3],
              'cap' => $row[4],
              'provincia' => $row[5],
              'note_indirizzo' => $row[6],
              'nazione' => $row[7],
              'nazione_sigla' => $this->parseNazione($row[7]),
              'email' => $row[8],
              'referente' => $row[9],
              'telefono' => $row[10],
              'partita_iva' => $row[11],
              'codice_fiscale' => $row[12],
              'note_extra' => $row[13],
              'pec' => $row[14],
              'codice_sdi' => $row[15],
            ]);
        }
    }

    protected function convertToUserId($field){
        if($field == 'ANNA'){
            return 4;
        } elseif($field == 'DAVIDE & ROBERTO'){
            return 5;
        } elseif($field == 'CLIENTE DIREZIONALE'){
            return 6;
        } elseif($field == 'BESSEM'){
            return 7;
        } elseif($field == 'GEMMA'){
            return 8;
        } elseif($field == 'ALONA'){
            return 9;
        } elseif($field == 'ELENA'){
            return 10;
        }
    }

    protected function parseNazione($field){
        foreach (help_country_iso3166() as $nazione) {
            if($nazione['nazione'] == $field){
                return $nazione['sigla'];
            }
        }
    }

    
}
