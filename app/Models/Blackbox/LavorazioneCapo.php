<?php

namespace App\Models\Blackbox;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LavorazioneCapo extends Model
{
    use HasFactory;

    protected $table = 'blackboxlavorazione_capo';
    protected $appends = ['lavorazione_id'];

    public function getLavorazioneIdAttribute(){
        return $this->id;
    }
}
