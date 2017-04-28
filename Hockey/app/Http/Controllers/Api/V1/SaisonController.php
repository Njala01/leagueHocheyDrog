<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Transformers\SaisonTransformer;
use App\Saison;
use Dingo\Api\Contract\Http\Request;
use Dingo\Api\Http\Response;
use Dingo\Api\Routing\Helpers;
use Illuminate\Routing\Controller;

class SaisonController extends Controller
{
	use Helpers;

    public function list() : Response
    {
    	return $this->response->collection(Saison::all(), new SaisonTransformer);
    }
}