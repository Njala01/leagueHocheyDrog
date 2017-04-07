<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ligue extends Model
{
    //

    public function joueur(){
    	return $this->hasMany(Joueur::class);
    }

    public function saison(){
    	return $this->belongsToMany(Saison::class);
    }
}
