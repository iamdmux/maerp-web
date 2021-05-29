<?php

namespace App\Models\Stock;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'stocks_cart_user';
    protected $fillable = ['user_id', 'lotto_id', 'quantita'];
}
