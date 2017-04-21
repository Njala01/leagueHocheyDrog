<?php

use Illuminate\Http\Request;
use Dingo\Api\Routing\Router;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

$api = app(Router::class);

$api->version('v1', [], function (Router $api) {
	//ÉQUIPES
    $api->get('/equipes', 'App\Http\Controllers\Api\V1\EquipeController@index');

    //PARTIES
    $api->get('/parties', 'App\Http\Controllers\Api\V1\PartieController@index');
    $api->get('/parties/edit', 'App\Http\Controllers\Api\V1\PartieController@edit');
    $api->get('/parties/edit/{partie}', 'App\Http\Controllers\Api\V1\PartieController@show');


    //$api->get('joueurs', 'App\Http\Controllers\Api\V1\JoueurController@index');
});