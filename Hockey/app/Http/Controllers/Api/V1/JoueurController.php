<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Transformers\JoueurTransformer;
use App\Joueur;
use Dingo\Api\Contract\Http\Request;
use Dingo\Api\Http\Response;
use Dingo\Api\Routing\Helpers;
use Illuminate\Routing\Controller;

class JoueurController extends Controller
{
	use Helpers;

    public function list() : Response
    {
    	return $this->response->collection(Joueur::all(), new JoueurTransformer);
    }
}