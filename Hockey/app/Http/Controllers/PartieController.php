<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Partie;

class PartieController extends Controller
{
    public function index()
    {
    	$parties = Partie::all();
    	return view('parties.index', compact('parties'));
    }

        public function edit()
    {
    	$parties = Partie::all();
    	return view('parties.edit', compact('parties'));
    }

        public function show()
    {
    	
    }

        public function update(Request $request, $id)
    {
    	    	$validator = Validator::make($request->all(), [
				'local_team' => 'required',
				'visitor_team' => 'required',
				'id_saison' => 'required',
				'titre' => 'required|max:50',
				'lieu' => 'required|max:50',
				'date' => 'required|date',
			]);

    	if($validator->fails()) {
    		return response()->json(['success'=>false, $validator->messages()], 200);
    	}

	    $partie = Partie::find($id);

	    $partie->id_saison = $request->id_saison;
	    $partie->titre = $request->titre;
	    $partie->lieu = $request->lieu;
	    $partie->date = $request->date;

	    $partie->save();

	    return response()->json(['p'=>$partie ],200);
    }

        public function create(Request $request)
    {
    	$validator = Validator::make($request->all(), [
				'local_team' => 'required',
				'visitor_team' => 'required',
				'id_saison' => 'required',
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
		$p->id_saison = (int) $request->id_saison;
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
