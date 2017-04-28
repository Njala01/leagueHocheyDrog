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
    $api->get('/raw/equipes', 'App\Http\Controllers\Api\V1\EquipeController@list');
    // Lister les parties et activer la modification dynamique en AJAX qui permet d'ajouter, modifier ou effacer
	// Restreint aux rôles : admin
    $api->post('/equipes/edit', ['as' => 'equipes.create', 'uses' => 'App\Http\Controllers\EquipeController@create']);
	//$api->put('/equipes/edit/{equipe}', ['as' => 'equipes.update', 'uses' => 'App\Http\Controllers\EquipeController@update']);
	$api->put('/equipes/edit/{equipe}', ['as' => 'equipes.update', 'uses' => 'App\Http\Controllers\EquipeController@update']
       /* function() {

		$rules = [
            'name' => ['required', 'max:50'],
            'admin_id' => ['required']
        ];

        $payload = app('request')->only('name', 'admin_id');

        $validator = app('validator')->make($payload, $rules);

        if ($validator->fails()) {
            //error_code(422);
        	return response()->json(['success'=>false, 'errors'=>$validator->messages()], 200);
            //throw new Dingo\Api\Exception\StoreResourceFailedException('Could not create new user.', $validator->errors());
        }
	}*/
    );
	$api->delete('/equipes/edit/{equipe}', ['as' => 'equipes.destroy', 'uses' => 'App\Http\Controllers\EquipeController@destroy']);

    //PARTIES
    $api->get('/raw/parties', 'App\Http\Controllers\Api\V1\PartieController@index');
    // Lister les équipes et activer la modification dynamique en AJAX qui permet d'ajouter, modifier ou effacer
	// Restreint aux rôles : admin
    $api->post('/parties/edit', ['as' => 'parties.create', 'uses' => 'App\Http\Controllers\PartieController@create']);
    $api->put('/parties/edit/{partie}', ['as' => 'equipes.update', 'uses' => 'App\Http\Controllers\PartieController@update']);
    $api->delete('/parties/edit/{partie}', ['as' => 'equipes.destroy', 'uses' => 'App\Http\Controllers\PartieController@destroy']);

    //JOUEURS
    $api->get('/raw/joueurs', 'App\Http\Controllers\Api\V1\JoueurController@index');
    // Lister les joueurs et activer la modification dynamique en AJAX qui permet d'ajouter, modifier ou effacer
    // Restreint aux rôles : admin
    $api->post('/joueurs/edit', ['as' => 'joueurs.create', 'uses' => 'App\Http\Controllers\JoueurController@create']);
 	$api->put('/joueurs/edit/{joueur}', ['as' => 'joueurs.update', 'uses' => 'App\Http\Controllers\JoueurController@update']);
	$api->delete('/joueurs/edit/{joueur}', ['as' => 'joueurs.destroy', 'uses' => 'App\Http\Controllers\JoueurController@destroy']);

	//SAISONS
	$api->get('/raw/joueurs', 'App\Http\Controllers\Api\V1\JoueurController@list');
	// Lister les joueurs et activer la modification dynamique en AJAX qui permet d'ajouter, modifier ou effacer
    // Restreint aux rôles : admin
    Route::post('/joueurs/edit', ['as' => 'joueurs.create', 'uses' => 'App\Http\Controllers\JoueurController@create']);
	Route::put('/joueurs/edit/{joueur}', ['as' => 'joueurs.update', 'uses' => 'App\Http\Controllers\JoueurController@update']);
	Route::delete('/joueurs/edit/{joueur}', ['as' => 'joueurs.destroy', 'uses' => 'App\Http\Controllers\JoueurController@destroy']);

	//LIGUES
	$api->get('/raw/ligues', 'App\Http\Controllers\Api\V1\LigueController@index');
	// Lister les joueurs et activer la modification dynamique en AJAX qui permet d'ajouter, modifier ou effacer
    // Restreint aux rôles : admin
    Route::post('/ligues/edit', ['as' => 'ligues.create', 'uses' => 'App\Http\Controllers\LigueController@create']);
	Route::put('/ligues/edit/{ligue}', ['as' => 'ligues.update', 'uses' => 'App\Http\Controllers\LigueController@update']);
	Route::delete('/ligues/edit/{ligue}', ['as' => 'ligues.destroy', 'uses' => 'App\Http\Controllers\LigueController@destroy']);

		//LIGUES
	$api->get('/raw/matchs', 'App\Http\Controllers\Api\V1\MatchController@index');
	// Lister les joueurs et activer la modification dynamique en AJAX qui permet d'ajouter, modifier ou effacer
    // Restreint aux rôles : admin
    Route::post('/matchs/edit', ['as' => 'matchs.create', 'uses' => 'App\Http\Controllers\MatchController@create']);
	Route::put('/matchs/edit/{match}', ['as' => 'matchs.update', 'uses' => 'App\Http\Controllers\MatchController@update']);
	Route::delete('/matchs/edit/{match}', ['as' => 'matchs.destroy', 'uses' => 'App\Http\Controllers\MatchController@destroy']);
});