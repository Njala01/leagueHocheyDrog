<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Transformers\EquipeTransformer;
use App\Equipe;
use Dingo\Api\Contract\Http\Request;
use Dingo\Api\Http\Response;
use Dingo\Api\Routing\Helpers;
use Illuminate\Routing\Controller;

class EquipeController extends Controller
{
	use Helpers;

    public function list() : Response
    {
    	return $this->response->collection(Equipe::all(), new EquipeTransformer);
    }
}