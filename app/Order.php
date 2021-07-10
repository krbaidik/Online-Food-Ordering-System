<?php

namespace App;
use App\Food;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = ['u_id','f_id','order_no','order_status','quantity','shipping_charge','total_price','order_note'];


    public function food(){
        return $this->belongsTo(Food::class,'f_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'u_id');
    }
}
