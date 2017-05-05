<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;
use Illuminate\View\View;
use App\Partie;
use App\Saison;
use Carbon;

class PartieController extends Controller
{
	use Helpers;

    public function index() : View
    {
        $parties = $this->api->get('/raw/parties/');
        //pour debug
        //echo $parties;
        return view('parties.index', compact('parties'));
    }

        public function editALL() : View
    {
    	$parties = $this->api->get('/raw/parties/'); 
    	return view('parties.edit', compact('parties'));
    }

    public function edit($id) : View
    {
        $saison = Saison::find($id);

        $parties = $saison->partie()->get();
    	return view('parties.edit', compact(['parties', 'id']));
    }

        public function update(Request $request, $id)
    {
    	    	$validator = Validator::make($request->all(), [
				'local_team' => 'required',
				'visitor_team' => 'required',
				'saison_id' => 'required',
				'titre' => 'required|max:50',
				'lieu' => 'required|max:50',
				'date' => 'required|date',
			]);

    	if($validator->fails()) {
    		return response()->json(['success'=>false, $validator->messages()], 200);
    	}

	    $partie = Partie::find($id);

		$partie->local_team = $request->local_team;
	    $partie->visitor_team = $request->visitor_team;
	    $partie->saison_id = $request->saison_id;
	    $partie->titre = $request->titre;
	    $partie->lieu = $request->lieu;
	    $partie->date = $request->date;

	    $partie->save();

	    return response()->json(['p'=>$partie, $request->id ],200);
    }

        public function create(Request $request)
    {
    	$validator = Validator::make($request->all(), [
				'local_team' => 'required',
				'visitor_team' => 'required',
				'saison_id' => 'required',
				'titre' => 'required|max:50',
				'lieu' => 'required|max:50',
				'date' => 'required|date',
			]);

    	if($validator->fails()) {
    		return response()->json(['success'=>false, $validator->messages()], 200);
    	}

		$p = new Partie;
		$p->local_team = (int) $request->local_team;
		$p->visitor_team = (int) $request->visitor_team;
		$p->saison_id = (int) $request->saison_id;
		$p->titre = $request->titre;
		$p->lieu = $request->lieu;
		$p->date = $request->date;

		$p->save();

     	return response()->json(['p'=>$p ],200);
    }

    public function destroy($id)
    {
		$partie = Partie::find($id);
		$partie->delete();

		return response()->json([ 'success'=>'true' ],200);

    }
}
