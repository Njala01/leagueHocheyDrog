<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Partie;

class PartieController extends Controller
{
    public function index()
    {
    	$parties = Partie::get();
    	return view('parties.index', compact('parties'));
    }
}
