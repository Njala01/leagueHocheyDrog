<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class partie extends Model
{
    //
	//public $timestamps = false;

    public function saison(){
    	return $this->belongsTo(Saison::class);
    }
    public function stats(){
    	return $this->hasMany(Stats::class);
    }

    public function getEquipe($id){
    	$equipe = Equipe::where('id', $id)->first()->name;
    	return $equipe;
    }

    
}
