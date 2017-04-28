<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Joueur;
use Dingo\Api\Routing\Helpers;
use Illuminate\View\View;

class JoueurController extends Controller
{
    use Helpers;

    public function index() : View
    {
        $joueurs = $this->api->get('/raw/joueurs/');
        return view('joueurs.index', compact('joueurs'));
    }

    public function edit() : View
    {
    	$joueurs = $this->api->get('/raw/joueurs/');
    	return view('joueurs.edit', compact('joueurs'));
    }

    public function update(Request $request, $id)
    {
    	    	$validator = Validator::make($request->all(), [
				'name' => 'required|max:50',
				'position' => 'required',
			]);

    	if($validator->fails()) {
    		return response()->json(['success'=>false, 'errors'=>$validator->messages()], 200);
    	}

	    $joueur = Joueur::find($id);

		$joueur->name = $request->name;
	    $joueur->position = $request->position;

	    $joueur->save();

	    return response()->json(['success'=>true, 'joueur'=>$joueur], 200);
    }

    public function create(Request $request)
    {
	    	$validator = Validator::make($request->all(), [
                'name' => 'required|max:50',
                'position' => 'required',
			]);

    	if($validator->fails()) {
    		return response()->json(['success'=>false, 'errors'=>$validator->messages()], 200);
    	}

		$joueur = new Joueur;
		$joueur->name = $request->name;
		$joueur->position = $request->position;

		$equipe->save();

     	return response()->json(['success'=>true, 'equipe'=>$equipe ], 200);
    }

    public function destroy($id)
    {
		$equipe = Equipe::find($id);
		$equipe->delete();

		return response()->json(['success'=>true], 200);
    }
}
}
