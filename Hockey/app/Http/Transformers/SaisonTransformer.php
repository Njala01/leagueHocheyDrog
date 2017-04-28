<?php

namespace App\Http\Transformers;

use App\Saison;
use League\Fractal\TransformerAbstract;

class SaisonTransformer extends TransformerAbstract
{
    public function transform(Saison $saison) : array
    {
        return [
        	'id' => $saison->id,
          	'name' => $saison->name,
          	'start_date' =>$saison->start_date,
          	'end_date' =>$saison->end_date,
          	'created_at' =>$saison->created_at,
          	'updated_at' =>$saison->updated_at
        ];
    }
}