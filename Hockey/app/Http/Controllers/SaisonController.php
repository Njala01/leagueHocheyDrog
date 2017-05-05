<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
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
        $saisons = Saison::All();
        return view('saisons.index', compact('saisons'));
    }
}
