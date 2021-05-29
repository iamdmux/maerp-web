<?php

namespace App\Models\Stock;

use App\Models\User;
use App\Models\Magazzino\Lotto;
use App\Models\Stock\ItemOrder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $table = 'stocks_orders';
    protected $fillable = ['user_id', 'subtotal'];

    public function items(){
        return $this->BelongsToMany(Lotto::class, 'stocks_items_orders')
        ->withPivot('id', 'quantita');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
