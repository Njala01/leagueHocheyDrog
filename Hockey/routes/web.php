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

// Index du site, montre les informations des parties à venir
Route::get('/', 'PartieController@index')->name('index');
//Route::resource('parties/edit', 'PartieController');

// Lister les parties et activer la modification dynamique en AJAX qui permet d'ajouter, modifier ou effacer
// Restreint aux rôles : admin
Route::get('/parties/edit', ['as' => 'parties.edit', 'uses' => 'PartieController@edit']);

Route::post('/parties/edit', ['as' => 'parties.create', 'uses' => 'PartieController@create']);

Route::put('/parties/edit/{partie}', ['as' => 'parties.update', 'uses' => 'PartieController@update']);

Route::delete('/parties/edit/{partie}', ['as' => 'parties.destroy', 'uses' => 'PartieController@destroy']);

/**********************************************************/


// Lister les équipes
Route::get('/equipes', 'EquipeController@index');

// Lister les équipes et activer la modification dynamique en AJAX qui permet d'ajouter, modifier ou effacer
// Restreint aux rôles : admin
Route::get('/equipes/edit', 'EquipeController@edit');

// Lister les joueurs
Route::get('/joueurs', 'JoueurController@index');

// Lister les joueurs et activer la modification dynamique en AJAX qui permet d'ajouter, modifier ou effacer
// Restreint aux rôles : admin
Route::get('/joueurs/edit', 'JoueurController@edit');

// Lister les saisons
Route::get('/saisons', 'SaisonController@index');

// Lister les saisons et activer la modification dynamique en AJAX qui permet d'ajouter, modifier ou effacer
// Restreint aux rôles : admin
Route::get('/saisons/edit', 'SaisonController@edit');