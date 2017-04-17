<?php

namespace App\Http\Controllers;

use App\Equipe;
use Dingo\Api\Routing\Helpers;
use Illuminate\View\View;

class EquipeController extends Controller
{

use Helpers;

    public function list() : View
    {
        $equipes = $this->api->get('/equipes/');
        //pour debug
        //echo $equipes;
        return view('equipes.index', compact('equipes'));
    }
}