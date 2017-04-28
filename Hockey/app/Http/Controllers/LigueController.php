<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Equipe;
use App\Ligue;
use Dingo\Api\Routing\Helpers;
use Illuminate\View\View;

class LigueController extends Controller
{
    use Helpers;

    public function index() : View
    {
        $ligues = $this->api->get('/raw/ligues/');
        return view('ligues.index', compact('ligues'));
    }

    public function edit() : View
    {
        $ligues = $this->api->get('/raw/ligues/');
        return view('ligues.edit', compact('ligues'));
    }

    public function update(Request $request, $id)
    {
    	    	$validator = Validator::make($request->all(), [
				'name' => 'required|max:255',
				'category' => 'required|max:255',
			]);

    	if($validator->fails()) {
    		return response()->json(['success'=>false, 'errors'=>$validator->messages()], 200);
    	}

	    $ligue = Ligue::find($id);

		$ligue->name = $request->name;
	    $ligue->category = $request->category;

	    $ligue->save();

	    return response()->json(['success'=>true, 'ligue'=>$ligue], 200);
    }

    public function create(Request $request)
    {
	    	$validator = Validator::make($request->all(), [
				'name' => 'required|max:255',
				'category' => 'required|max:255',
			]);

    	if($validator->fails()) {
    		return response()->json(['success'=>false, 'errors'=>$validator->messages()], 200);
    	}

		$ligue = new Ligue;
		$ligue->name = $request->name;
	    $ligue->category = $request->category;

	    $ligue->save();

     	return response()->json(['success'=>true, 'ligue'=>$ligue], 200);
    }

    public function destroy($id)
    {
		$ligue = Ligue::find($id);
		$ligue->delete();

		return response()->json(['success'=>true], 200);
    }
}
