<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Joueur;
use App\Equipe;
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

        public function editAll() : View
    {
        //$joueurs = $this->api->get('/raw/joueurs/');
        $joueurs = Joueur::All();
        $id = 0;
        return view('joueurs.edit', compact(['joueurs', 'id']));
    }

    public function edit($id) : View
    {
        $equipe = Equipe::find($id);
        $joueurs = $equipe->joueur();
    	return view('joueurs.edit', compact(['joueurs', 'id']));
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
        $joueur->partieJouer = 0;
        $joueur->but = 0;
        $joueur->assist = 0;
        $joueur->points = 0;

        if($request->equipe_name != 0)
        {
            $equipe = Equipe::find($request->equipe_name);
            $joueur->equipe = $equipe;
        }

		$joueur->save();

     	return response()->json(['success'=>true, 'joueur'=>$joueur ], 200);
    }

    public function destroy($id)
    {
		$joueur = Joueur::find($id);
		$joueur->delete();

		return response()->json(['success'=>true], 200);
    }
}
