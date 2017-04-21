<?php

namespace App\Http\Transformers;

use App\Partie;
use League\Fractal\TransformerAbstract;

class PartieTransformer extends TransformerAbstract
{
    public function transform(Partie $partie) : array
    {
        return [
          'id' => $partie->id,
           'local_team' => $partie->local_team,
           'visitor_team' => $partie->visitor_team,
           'id_saison' => $partie->id_saison,
           'titre' => $partie->titre,
           'lieu' => $partie->lieu,
           'date' => $partie->date,
           'winning_team' => $partie->winning_team,
           'losing_team' => $partie->losing_team,
           'final_score_local' => $partie->final_score_local,
           'final_score_visitor' => $partie->final_score_visitor,
           'created_at' => $partie->created_at,
           'updated_at' => $partie->updated_at
        ];
    }
}