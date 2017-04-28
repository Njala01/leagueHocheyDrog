<?php

namespace App\Http\Transformers;

use App\Joueur;
use League\Fractal\TransformerAbstract;

class JoueurTransformer extends TransformerAbstract
{
    public function transform(Joueur $joueur) : array
    {
        return [
        	'id' => $joueur->id,
          	'name' => $joueur->name,
          	'position' =>$joueur->position,
          	'user_id' =>$joueur->user_id,
          	'created_at' =>$joueur->created_at,
          	'updated_at' =>$joueur->updated_at
        ];
    }
}