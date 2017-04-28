<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class equipe extends Model
{
    //

    /*public function user()
    {
    	return $this->belongsTo(User::class);
    }*/

    public function ligue(){
    	return $this->belongsTo(Ligue::class);
    }

    public function joueurs(){
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

    public function getPoint($id){
        $win = Partie::where('winning_team', $id)->count();
        return $win * 2;
    }

}
