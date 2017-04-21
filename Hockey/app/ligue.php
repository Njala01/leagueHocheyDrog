<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ligue extends Model
{
    //

    public function equipe(){
    	return $this->hasMany(Equipe::class);
    }

    public function saison(){
    	return $this->hasMany(Saison::class);
    }
}
