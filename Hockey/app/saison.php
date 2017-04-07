<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class saison extends Model
{
    //
    public function ligue(){
    	return $this->hasMany(Ligue::class);
    }
    public function partie(){
    	return $this->hasMany(Partie::class);
    }
}
