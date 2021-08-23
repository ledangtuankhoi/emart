<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $fillable=['code','type','value','status'];

    
    public function discount($total_price){
        // dd($this,$this->value/100, );
        if($this->type == "fixed"){
            return  $this->value;
        }elseif($this->type == "percent"){
            $total_price = filter_var($total_price, FILTER_SANITIZE_NUMBER_INT); 
            return ($this->value/100)*$total_price;
        }else{
            return 0;
        }
    }
}
