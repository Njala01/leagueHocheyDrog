<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class joueur extends Model
{
    //

    public function equipe(){
    	return $this->belongsToMany(Equipe::class);
    }

    /*public function joueur_position(){
    	return $this->hasMany(Joueur_position::class);
    }*/

    public function user(){
    	return $this->hasOne(User::class);
    }

    public function stats_joueur(){
    	return $this->hasMany(Stats_joueur::class);
    }
}
