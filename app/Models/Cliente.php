<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cliente extends Model
{
    use HasFactory;
    
    protected $table = "clienti";
    protected $guarded = [];

    const TIPOLOGIA = [
        ['val' => 'azienda',                'show'=> 'Azienda'],
        ['val' => 'persona_fisica',         'show'=> 'Persona Fisica'],
        ['val' => 'pubblica_amministrazione', 'show'=> 'Pubblica Amministrazione'],
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
