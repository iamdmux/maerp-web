<?php

namespace App\Models;

use App\Models\Vendite\Cliente;
use App\Models\Vendite\Fattura;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    const RESPONSABILE_MAGAZZINO_ID = 11;

    public function clienti(){
        return $this->hasMany(Cliente::class);
    }
    
    public function fatture(){
        return $this->hasMany(Fattura::class);
    }
}
