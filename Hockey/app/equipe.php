<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class equipe extends Model
{
    //

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function ligue(){
    	return $this->belongsToMany(Ligue::class);
    }

    public function joueur(){
    	return $this->belongsToMany(Joueur::class);
    }

	//Afficher une liste des équipes existante
    public static function TeamLists()
	{
		return static::selectRaw('name')
    		->orderByRaw('created_at desc')
    		->get()
    		->toArray();
	}

}
