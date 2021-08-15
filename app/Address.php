<?php

namespace App;
use App\District;
use App\City;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'addresses';

    public function district(){
        return $this->belongsTo(District::class,'district_id');
    }

    public function city(){
        return $this->belongsTo(City::class,'city_id');
    }
}
