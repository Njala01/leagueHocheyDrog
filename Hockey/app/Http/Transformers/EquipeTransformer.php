<?php

namespace App\Http\Transformers;

use App\Equipe;
use League\Fractal\TransformerAbstract;

class EquipeTransformer extends TransformerAbstract
{
    public function transform(Equipe $equipe) : array
    {
        return [
        	'id' => $equipe->id,
          	'name' => $equipe->name,
          	'admin_id' =>$equipe->admin_id,
          	'ligue_id' =>$equipe->ligue_id,
          	'created_at' =>$equipe->created_at,
          	'updated_at' =>$equipe->updated_at
        ];
    }
}