<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class equipe extends Model
{
    //

    public function ligue(){
    	return $this->belongsToMany(Ligue::class);
    }

    public function joueur(){
    	return $this->belongsToMany(Joueur::class);
    }

}
