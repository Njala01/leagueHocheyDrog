<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
<<<<<<< HEAD
use App\Saison;
use App\Ligue;
=======
use App\Joueur;
use App\Equipe;
>>>>>>> 0aab8c4b31d8553304f2a428faba03d78b86c5ea
use Dingo\Api\Routing\Helpers;
use Illuminate\View\View;

class SaisonController extends Controller
{
<<<<<<< HEAD
    use Helpers;

    public function index() : View
    {
        $saisons = $this->api->get('/raw/saisons/');
        //pour debug
        //echo $equipes;
        return view('saisons.index', compact('saisons'));
    }

    public function edit() : View
    {
    	$saisons = $this->api->get('/raw/saisons/');
    	$ligues = Ligue::all(['id', 'name'])->pluck('name', 'id');
    	return view('saisons.edit', compact(['saisons', 'ligues']));
    }

    public function update(Request $request, $id)
    {
    	    	$validator = Validator::make($request->all(), [
				'name' => 'required|max:50',
				'admin_id' => 'required',
				'ligue_id' => 'required',
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
				'ligue_id' => 'required',
				'start_date' => 'required',
				'end_date' => 'required',
			]);

    	if($validator->fails()) {
    		return response()->json(['success'=>false, 'errors'=>$validator->messages()], 200);
    	}

		$saison = new Saison;
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
=======
	use Helpers;
	
    public function index() : View
    {
        $saisons = $this->api->get('/raw/saisons/');
        $saisons = Saison::All();
        return view('saisons.index', compact('saisons'));
    }
>>>>>>> 0aab8c4b31d8553304f2a428faba03d78b86c5ea
}
