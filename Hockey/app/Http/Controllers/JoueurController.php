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
        //pour debug
        //echo $equipes;
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
				'user_id' => 'required',
			]);

    	if($validator->fails()) {
    		return response()->json(['success'=>false, 'errors'=>$validator->messages()], 200);
    	}

	    $equipe = Equipe::find($id);

		$equipe->name = $request->name;
	    $equipe->admin_id = $request->admin_id;
	    $equipe->ligue_id = $request->ligue_id;

	    $equipe->save();

	    return response()->json(['success'=>true, 'equipe'=>$equipe], 200);
    }

    public function create(Request $request)
    {
	    	$validator = Validator::make($request->all(), [
				'name' => 'required|max:50',
				'admin_id' => 'required',
				'ligue_id' => 'required',
			]);

    	if($validator->fails()) {
    		return response()->json(['success'=>false, 'errors'=>$validator->messages()], 200);
    	}

		$equipe = new Equipe;
		$equipe->name = $request->name;
		$equipe->admin_id = (int) $request->admin_id;
		$equipe->ligue_id = (int) $request->ligue_id;

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
