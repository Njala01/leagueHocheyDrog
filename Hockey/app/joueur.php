<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class joueur extends Model
{
    //

    public function equipes(){
    	return $this->belongsToMany(Equipe::class);
    }

    /*public function joueur_position(){
    	return $this->hasMany(Joueur_position::class);
    }*/

    public function user(){
    	return $this->hasOne(User::class);
    }

    public function stats(){
    	return $this->hasMany(Stats::class);
    }
}
