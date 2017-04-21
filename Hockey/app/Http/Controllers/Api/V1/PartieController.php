<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Transformers\PartieTransformer;
use App\Partie;
use Dingo\Api\Contract\Http\Request;
use Dingo\Api\Http\Response;
use Dingo\Api\Routing\Helpers;
use Illuminate\Routing\Controller;
use Carbon;

class PartieController extends Controller
{
	use Helpers;

    public function index(Request $request) : Response
    {
    	return $this->response->collection(Partie::where('date', '>', Carbon\Carbon::today())->orderBy('date', 'asc')->get(), new PartieTransformer);
    }

        public function edit(Request $request) : Response
    {
    	return $this->response->collection(Partie::all(), new PartieTransformer);
    }

    public function show(Request $request) : Response
    {
    	return $this->response->item(Partie::find($request->id), new PartieTransformer);
    	//return $request;
    }
}