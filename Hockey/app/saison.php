<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class saison extends Model
{
    //
    public function ligue(){
    	return $this->belongsTo(Ligue::class);
    }
    public function partie(){
    	return $this->hasMany(Partie::class);
    }

    public function getMatch($id){
    	$matchs = Partie::where('saison_id', $id);
    	return $match;
    }
}
