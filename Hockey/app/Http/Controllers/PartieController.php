<?php

namespace App\Http\Controllers;

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
	    $partie = Partie::find($id);

	    $partie->id_saison = $request->id_saison;
	    $partie->titre = $request->titre;
	    $partie->lieu = $request->lieu;
	    $partie->date = $request->date;

	    $partie->save();

	    return response()->json(['p'=>$partie ],200);
    }

        public function create()
    {
		$p = new Partie;
		$p->titre = request()->input('titre');
		$p->id_saison = (int) request()->input('id_saison');
		$p->lieu = request()->input('lieu');
		$p->date = request()->input('date');

		$p->save();

     	return response()->json(['p'=>$p ],200);
    }
}
