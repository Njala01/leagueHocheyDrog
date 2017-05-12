<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Equipe;
use App\Ligue;
use App\User;
use Dingo\Api\Routing\Helpers;
use Illuminate\View\View;

class EquipeController extends Controller
{

use Helpers;

    public function index() : View
    {
        $equipes = $this->api->get('/raw/equipes/');
        //pour debug
        //echo $equipes;
        return view('equipes.index', compact('equipes'));
    }

    public function edit() : View
    {
    	$equipes = $this->api->get('/raw/equipes/');
        $ligues = Ligue::All(['id', 'name']);
        $admins = User::All(['id', 'name']);
    	return view('equipes.edit', compact(['equipes', 'ligues', 'admins']));
    }

    public function ligueEdit($id) : View
    {
        $equipes = Equipe::where('ligue_id', $id)->get();
        $ligues = Ligue::All(['id', 'name']);
        $admins = User::All(['id', 'name']);
        return view('equipes.edit', compact(['equipes', 'ligues', 'admins']));
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

        $ligues = Ligue::All(['id', 'name']);
        $admins = User::All(['id', 'name']);

     	return response()->json(['success'=>true, 'equipe'=>$equipe, 'ligues'=>$ligues, 'admins'=>$admins ], 200);
    }

    public function destroy($id)
    {
		$equipe = Equipe::find($id);
		$equipe->delete();

		return response()->json(['success'=>true], 200);

    }
}
