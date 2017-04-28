<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class stat_type extends Model
{
    //

    public function stats(){
    	return $this->hasMany(Stats::class);
    }
}
