<?php

namespace App\Models;

use App\Models\Stock\Order;
use Illuminate\Support\Str;
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
        'slug'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    const RESPONSABILE_MAGAZZINO_ID = 11;
    const SLUGLENGTH = 7;

    // SLUG
    public function getRouteKeyName(){
        return 'slug';
    }

    private static function createUid($num){
        return Str::random($num);
    }

    protected static function boot()
    {
        parent::boot();
    
        // auto-sets values on creation
        static::creating(function ($user) {
            $uniqid = static::createUid(self::SLUGLENGTH);

            do {
                $uniqid = static::createUid(self::SLUGLENGTH);
            }
            while ($uniqid == self::where('slug', $uniqid)->exists());
            $user->slug = $uniqid;
        });
    }

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
        return $this->hasMany(Order::class)->orderBy('created_at', 'DESC');;
    }

    public function account(){
        return $this->hasOne(Cliente::class, 'stock_user_id');
    }
}
