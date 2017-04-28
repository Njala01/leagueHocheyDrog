<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Transformers\LigueTransformer;
use App\Ligue;
use Dingo\Api\Contract\Http\Request;
use Dingo\Api\Http\Response;
use Dingo\Api\Routing\Helpers;
use Illuminate\Routing\Controller;

class LigueController extends Controller
{
	use Helpers;

    public function list() : Response
    {
    	return $this->response->collection(Ligue::all(), new LigueTransformer);
    }
}