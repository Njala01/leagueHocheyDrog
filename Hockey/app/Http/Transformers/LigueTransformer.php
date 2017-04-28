<?php

namespace App\Http\Transformers;

use App\Ligue;
use League\Fractal\TransformerAbstract;

class LigueTransformer extends TransformerAbstract
{
    public function transform(Ligue $ligue) : array
    {
        return [
        	'id' => $ligue->id,
          	'name' => $ligue->name,
          	'category' =>$ligue->category,
          	'created_at' =>$ligue->created_at,
          	'updated_at' =>$ligue->updated_at
        ];
    }
}