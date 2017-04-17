<?php
use App\Partie;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*****    DINGO API    ******/
//Pour voir les datas des équipes brut:
//http://hockey.app:8000/api/equipes

Route::get('equipes', 'EquipeController@list');

/*************************************************************/
// Index du site, montre les informations des parties à venir
Route::get('/', 'PartieController@index')->name('index');

// Lister les parties et activer la modification dynamique en AJAX qui permet d'ajouter, modifier ou effacer
// Restreint aux rôles : admin
Route::get('/parties/edit', ['as' => 'parties.edit', 'uses' => 'PartieController@edit']);
Route::post('/parties/edit', ['as' => 'parties.create', 'uses' => 'PartieController@create']);
Route::put('/parties/edit/{partie}', ['as' => 'parties.update', 'uses' => 'PartieController@update']);
Route::delete('/parties/edit/{partie}', ['as' => 'parties.destroy', 'uses' => 'PartieController@destroy']);
/**********************************************************/


// Lister les équipes
//Route::get('/equipes', 'EquipeController@index');

// Lister les équipes et activer la modification dynamique en AJAX qui permet d'ajouter, modifier ou effacer
// Restreint aux rôles : admin
Route::get('/equipes/edit', ['as' => 'equipes.edit', 'uses' => 'EquipeController@edit']);
Route::post('/equipes/edit', ['as' => 'equipes.create', 'uses' => 'EquipeController@create']);
Route::put('/equipes/edit/{equipe}', ['as' => 'equipes.update', 'uses' => 'EquipeController@update']);
Route::delete('/equipes/edit/{equipe}', ['as' => 'equipes.destroy', 'uses' => 'EquipeController@destroy']);
/**********************************************************/

// Lister les joueurs
Route::get('/joueurs', 'JoueurController@index');

// Lister les joueurs et activer la modification dynamique en AJAX qui permet d'ajouter, modifier ou effacer
// Restreint aux rôles : admin
Route::get('/joueurs/edit', ['as' => 'joueurs.edit', 'uses' => 'JoueurController@edit']);
Route::post('/joueurs/edit', ['as' => 'joueurs.create', 'uses' => 'JoueurController@create']);
Route::put('/joueurs/edit/{joueur}', ['as' => 'joueurs.update', 'uses' => 'JoueurController@update']);
Route::delete('/joueurs/edit/{joueur}', ['as' => 'joueurs.destroy', 'uses' => 'JoueurController@destroy']);
/**********************************************************/

// Lister les saisons
Route::get('/saisons', 'SaisonController@index');

// Lister les saisons et activer la modification dynamique en AJAX qui permet d'ajouter, modifier ou effacer
// Restreint aux rôles : admin
Route::get('/saisons/edit', ['as' => 'saisons.edit', 'uses' => 'SaisonController@edit']);
Route::post('/saisons/edit', ['as' => 'saisons.create', 'uses' => 'SaisonController@create']);
Route::put('/saisons/edit/{saison}', ['as' => 'saisons.update', 'uses' => 'SaisonController@update']);
Route::delete('/saisons/edit/{saison}', ['as' => 'saisons.destroy', 'uses' => 'SaisonController@destroy']);
/**********************************************************/
