<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EquipeController extends Controller
{
    public function index()
    {
    	$equipes = Equipe::latest()->get();
    	return view('equipes.index', compact('equipes'));
    }
}