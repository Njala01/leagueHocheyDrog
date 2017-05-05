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

class SaisonController extends Controller
{
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
    	$ligues = Ligue::All(['id', 'name']);
    	return view('saisons.edit', compact(['saisons', 'ligues']));
    }

    public function update(Request $request, $id)
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

	    $saison = Saison::find($id);
		$saison->name = $request->name;
		$saison->ligue_id = $request->ligue_id;
		$saison->start_date = $request->start_date;
		$saison->end_date = $request->end_date;

	    $saison->save();

	    return response()->json(['success'=>true, 'saison'=>$saison], 200);
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
		$saison->name = $request->name;
		$saison->ligue_id = $request->ligue_id;
		$saison->start_date = $request->start_date;
		$saison->end_date = $request->end_date;

		$saison->save();

	    $ligues = Ligue::All(['id', 'name']);
	    $saisons = Saison::All(['id', 'name']);

     	return response()->json(['success'=>true, 'saison'=>$saison, 'ligues'=>$ligues, 'saisons'=>$saisons ], 200);
    }

    public function destroy($id)
    {
		$saison = Saison::find($id);
		$saison->delete();

		return response()->json(['success'=>true], 200);

    }
}
