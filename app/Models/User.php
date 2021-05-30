<?php

namespace App\Models;

use App\Models\Stock\Order;
use App\Models\Magazzino\Lotto;
use App\Models\Stock\Cart\Cart;
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

    public function cart(){
        return $this->belongsToMany(Lotto::class, 'stocks_cart_user', 'user_id', 'lotto_id')
        ->withPivot('id', 'quantita', 'prezzo')
        ->withTimestamps();
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function account(){
        return $this->hasOne(Cliente::class, 'stock_user_id');
    }
}
