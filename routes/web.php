<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('accueil');
});
Auth::routes(['verify' => true]);
Auth::routes();
Route::group(['middleware' => ['auth','developpeur']], function () {
    Route::view('/projets', 'livewire.projet.accueil');
    Route::view('/groupe','livewire.groupe.groupe_participant')->name('groupe');
    Route::view('/user_profile','livewire.developpeur.view_profile');
    Route::view('/user_projet','livewire.user.user_projet');
    Route::view('/form_depot', 'livewire.depot.form_depot');
    Route::view('/form_partenaire','paiement_partenaire.formulaire');
    Route::view('/resultat', 'livewire.depot.resultat_view');
    Route::view('/participation_success','livewire.participation.participation_success');
    Route::view('/participation_etablissement','livewire.participation.participation_etablissement');
    Route::view('/depot_success','livewire.depot.depot_success');
    Route::view('/detail_projet','livewire.projet.detail');
    Route::view('choix_paiement','livewire.developpeur.paiement');
    Route::get('/paiement','PaiementController@formulaire');
    Route::post('paiement','PaiementController@process');
    Route::get('/paiementok','PaiementController@paiementok');
    Route::post('payment', 'PaiementController@payStripe');
    Route::view('/paimentSucces','PaiementPartenaire.paimentSucces');
    Route::view('/validation','livewire.developpeur.validation');
    Route::view('/choix_paiment_success','livewire.developpeur.choix-paiement-success');
    Route::view('/decouvrir','livewire.projet.view_decouvrir');
});
Route::view('/form_developer', 'livewire.demande.form_developpeur')->middleware('auth');

//Route::get('/markasread','HomeControlle@markasread')->name('markasread')->middleware('auth');
Route::get('/markasread',[App\Http\Controllers\HomeController::class, 'markasread'])->name('markasread');
Route::get('/markasreadcdo/{id}',[App\Http\Controllers\HomeController::class, 'markasreadcdo']);

Route::get('/home', 'HomeController@index')->name('home');
Route::view('/accueil', 'accueil');
Route::group(['middleware' => ['auth','admin']], function () {
    Route::view('/liste_categorie','livewire.categorie.liste_categorie')->name('categories');
    Route::view('/liste_competence','livewire.competence.liste_competence');
    Route::view('/participant', 'livewire.participation.participation')->name('participants');
    Route::view('/liste_projet', 'livewire.projet.liste_projet')->name('projets');
    Route::view('/form_projet','livewire.projet.formulaire');
    Route::view('/liste_groupe','livewire.groupe.liste_groupe')->name('groupes');
    Route::view('/liste_developpeur','livewire.developpeur.liste_developpeur');
    Route::view('/liste_depot','livewire.depot.depot');
    Route::view('/liste_demande','livewire.cdo.demande');
    Route::view('/demande_developpeur','livewire.developpeur.demande_dev');
    Route::view('/liste_partenaire','livewire.cdo.liste_cdo');
    Route::view('/parametre','livewire.parametre.view_parametre');
    Route::view('/proclamation','livewire.depot.view_proclamation');
    Route::view('/dashboard','livewire.view_dashboard');
   // Route::view('/user_profile','livewire.developpeur.view_profile');
    Route::get('admin', 'HomeController@admin')->name('admin');


});

Route::group(['middleware' => ['auth','cdo']], function () {
    
    Route::view('/accueil_cdo','livewire.cdo.view_accueil');
    Route::view('/cdo_validation','livewire.cdo.validation_cdo');
    Route::view('/dashboard','livewire.view_dashboard');
    Route::view('/liste_projet', 'livewire.projet.liste_projet')->name('projets');
    Route::view('/participant', 'livewire.participation.participation')->name('participants');
    Route::view('/liste_depot','livewire.depot.depot');
    Route::view('/liste_developpeur','livewire.developpeur.liste_developpeur');
    Route::view('/archive','livewire.projet.archive_view');
    Route::view('/profile','livewire.developpeur.profileprAdmin');
    Route::view('/form_projet','livewire.projet.formulaire');
    Route::view('/paiement_cdo_success','livewire.cdo.paiement_cdo_success');
    
});
Route::view('/bienvenue','livewire.demande.bienvenue')->middleware('auth');;

