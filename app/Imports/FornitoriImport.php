<?php

namespace App\Imports;

use App\Models\Acquisti\Fornitore;
use Maatwebsite\Excel\Concerns\ToModel;

class FornitoriImport implements ToModel
{
    private $rows = 0;

    public function model(array $row)
    {
        ++$this->rows;

        if($this->rows > 1 && $this->rows < 213){
            return new Fornitore([
                    'denominazione' => $row[0],
                    'indirizzo' => $row[2],
                    'citta' => $row[3],
                    'cap' => $row[4],
                    'provincia' => $row[5],
                    'paese' =>  $row[6],
                    'partita_iva' =>  $row[10],
            ]);
        }
    }
}