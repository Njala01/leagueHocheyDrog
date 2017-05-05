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
Route::get('/', ['as' => 'equipes.index', 'uses' => 'EquipeController@index'])->name('home');

Route::get('/equipes', ['as' => 'equipes.index', 'uses' => 'EquipeController@index']);
Route::get('/equipes/edit', ['as' => 'equipes.edit', 'uses' => 'EquipeController@edit']);

Route::get('/joueurs', ['as' => 'joueurs.index', 'uses' => 'JoueurController@index']);
Route::get('/joueurs/edit', ['as' => 'joueurs.editAll', 'uses' => 'JoueurController@editAll']);
Route::get('/equipes/{id}/joueurs', ['as' => 'joueurs.index', 'uses' => 'JoueurController@index']);
Route::get('/equipes/{id}/joueurs/edit', ['as' => 'joueurs.edit', 'uses' => 'JoueurController@edit']);

Route::get('/parties', ['as' => 'parties.index', 'uses' => 'PartieController@index']);
Route::get('/parties/edit', ['as' => 'parties.edit', 'uses' => 'PartieController@editALL']);
Route::get('/saisons/{id}/parties/edit', ['as' => 'parties.edit', 'uses' => 'PartieController@edit']);

Route::get('/partieEnCour', ['as' => 'parties.enCour', 'uses' => 'PartieController@enCour']);

Route::get('/saisons', ['as' => 'saisons.index', 'uses' => 'SaisonController@index']);
Route::get('/saisons/edit', ['as' => 'saisons.edit', 'uses' => 'SaisonController@edit']);

Route::get('/ligues', ['as' => 'ligues.index', 'uses' => 'LigueController@index']);
Route::get('/ligues/edit', ['as' => 'ligues.edit', 'uses' => 'LigueController@edit']);

Route::get('/matchs', ['as' => 'matchs.index', 'uses' => 'MatchController@index']);
Route::get('/matchs/edit', ['as' => 'matchs.edit', 'uses' => 'MatchController@edit']);

Auth::routes();