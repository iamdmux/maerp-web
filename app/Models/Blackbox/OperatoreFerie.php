<?php

namespace App\Models\Blackbox;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OperatoreFerie extends Model
{
    use HasFactory;

    protected $table = 'blackbox_operatoreferie';
    protected $dates = ['dal', 'al'];
    protected $guarded = [];
    public $timestamps = false;

    public function getDalStringsAttribute(){
        return Carbon::parse($this->dal)->isoFormat('dddd D MMMM Y');
    }
    public function getAlStringsAttribute(){
        return Carbon::parse($this->al)->isoFormat('dddd D MMMM Y');
    }

    public function operatore(){
        return $this->belongsTo(Operatore::class);
    }

}
