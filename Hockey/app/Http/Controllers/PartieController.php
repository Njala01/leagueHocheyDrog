<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;
use Illuminate\View\View;
use App\Partie;
use App\Saison;
use App\Equipe;
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

    public function marquer($id){
        $partie = Partie::find($id);
        $local = Equipe::where("id", $partie->local_team)->first();
        $visitor = Equipe::where("id", $partie->visitor_team)->first();

        return view('parties.marquer', compact(['local', 'visitor', 'id']));
    }

    public function marquerBut(Request $request, $id){

        $partie = Partie::find($id);

        $equipe = Equipe::find($request->equipe);
        $joueurBut = $equipe->joueurs()->find($request->joueurBut);

        $joueurBut->but = $joueurBut->but + 1;
        $joueurBut->points = $joueurBut->points + 1;
        $joueurBut->save();

        if($partie->local_team == $equipe->id)
        {
            $partie->final_score_local = $partie->final_score_local + 1;
        } else
        {
            $partie->final_score_visitor = $partie->final_score_visitor + 1;
        }

        $partie->save();

        if($request->joueurAssist != "")
        {
            $joueurAssist = $equipe->joueurs()->find($request->joueurAssist);
            $joueurAssist->but = $joueurAssist->assist + 1;
            $joueurAssist->points = $joueurAssist->points + 1;
            $joueurAssist->save();
        }

        return response()->json(['p'=>$partie, $request ],200);
    }

    public function marquerTerminer($id)
    {
        $partie = Partie::find($id);

        if($partie->final_score_local == null)
        {
            $partie->final_score_local = 0;
        }

        if($partie->final_score_visitor == null)
        {
            $partie->final_score_visitor = 0;
        }

        if($partie->final_score_local >= $partie->final_score_visitor)
        {
            $partie->winning_team = $partie->local_team;
            $partie->losing_team = $partie->visitor_team;
        } else 
        {
            $partie->winning_team = $partie->visitor_team;
            $partie->losing_team = $partie->local_team;
        }

        $partie->save();

        return response()->json(['p'=>$partie],200);
    }

    public function editALL() : View
    {
        $parties = Partie::all();
        $equipes = Equipe::all(['id', 'name']);
        $saisons = Saison::all(['id', 'name']);
        $id = 0;
    	return view('parties.edit', compact(['parties', 'id', 'equipes', 'saisons']));
    }

    public function edit($id) : View
    {
        $saison = Saison::find($id);

        $parties = $saison->partie()->get();
        $equipes = Equipe::all(['id', 'name']);
        $saisons = Saison::all(['id', 'name']);
    	return view('parties.edit', compact(['parties', 'id', 'equipes', 'saisons']));
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

		$partie->local_team = (int)$request->local_team;
	    $partie->visitor_team = (int)$request->visitor_team;
	    $partie->saison_id = (int)$request->saison_id;
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

                $equipes = Equipe::all(['id', 'name']);
        $saisons = Saison::all(['id', 'name']);

     	return response()->json(['p'=>$p, 'equipes'=>$equipes, 'saisons'=>$saisons ],200);
    }

    public function destroy($id)
    {
		$partie = Partie::find($id);
		$partie->delete();

		return response()->json([ 'success'=>'true' ],200);

    }

    public function enCour($match){
        $partie = Partie::where("id", $match);
        $local = Equipe::where("id", $partie->local_team);
        $visitor = Equipe::where("id", $partie->visitor_team);

        return view('parties.enCour', compact(['local', 'vistor']));
    }
}
