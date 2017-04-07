<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class partie extends Model
{
    //

    public function saison(){
    	return $this->belongsTo(Saison::class);
    }
    public function stats(){
    	return $this->hasMany(Stats::class);
    }
}
