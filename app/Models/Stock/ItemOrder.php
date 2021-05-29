<?php

namespace App\Models\Stock;

use App\Models\Stock\Order;
use App\Models\Magazzino\Lotto;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ItemOrder extends Model
{
    use HasFactory;

    protected $table = 'stocks_items_orders';
    protected $fillable = ['order_id', 'lotto_id', 'quantita'];
    public $timestamps = false;

    // public function lotti(){
    //     return $this->belongsTo(Lotto::class, 'lotto_id');
    // }

    public function order(){
        return $this->belongsTo(Order::class);
    }
}
