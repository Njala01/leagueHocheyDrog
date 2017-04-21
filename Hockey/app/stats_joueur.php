<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class stats_joueur extends Model
{
    //

    public function joueur(){
    	return $this->belongsTo(Joueur::class);
    }
}
