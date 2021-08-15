<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected function districts(){
    	return $this->belongsTo(District::class,'district_id');
    }
}
