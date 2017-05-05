<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Saison;
use App\Ligue;
use App\Joueur;
use App\Equipe;
use Dingo\Api\Routing\Helpers;
use Illuminate\View\View;


class JoueurController extends Controller
{
    use Helpers;

    public function index() : View
    {
        $joueur = $this->api->get('/raw/joueurs/');
        //pour debug
        //echo $equipes;
        return view('joueurs.index', compact('joueurs'));
    }

        public function editAll() : View
    {
        //$joueurs = $this->api->get('/raw/joueurs/');
        $joueurs = Joueur::All();
        $equipes = Equipe::All(['id', 'name']);
        $id = 0;
        return view('joueurs.edit', compact(['joueurs', 'id', 'equipes']));
    }

    public function edit($id) : View
    {
        $equipe = Equipe::find($id);
        $joueurs = $equipe->joueurs()->get();
        $equipes = Equipe::All(['id', 'name']);

    	return view('joueurs.edit', compact(['joueurs', 'id', 'equipes']));
    }

    public function update(Request $request, $id)
    {
                $equipe = Equipe::find($request->equipe_name);

    	    	$validator = Validator::make($request->all(), [
				'name' => 'required|max:50',
				'position' => 'required',
			]);

                if($equipe = null)
                {
                    $validator->getMessageBag()->add('equipe', 'Equipe pas trouvés');
                }

    	if($validator->fails()) {
    		return response()->json(['success'=>false, 'errors'=>$validator->messages()], 200);
    	}

	    $joueur = Joueur::find($id);
        $equipe = Equipe::find($request->equipe_name);

		$joueur->name = $request->name;
	    $joueur->position = $request->position;

        $joueur->equipes()->detach($equipe->id);
        $joueur->equipes()->attach($request->equipe_name);

	    $joueur->save();

	    return response()->json(['success'=>true, 'joueur'=>$joueur, 'id'=>$equipe], 200);
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

		$joueur->save();

        if($request->equipe_name != 0)
        {
            $joueur->equipes()->attach($request->equipe_name);
            $equipe = Equipe::find($request->equipe_name);
        }

     	return response()->json(['success'=>true, 'joueur'=>$joueur, 'equipe'=>$equipe ], 200);
    }

    public function destroy($id)
    {
		$joueur = Joueur::find($id);
		$joueur->delete();

		return response()->json(['success'=>true], 200);
    }
}
