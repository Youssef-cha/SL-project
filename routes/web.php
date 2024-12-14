<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\BonCommandeController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\ComplexeController;
use App\Http\Controllers\DepotController;
use App\Http\Controllers\EfpController;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\LivraisonController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\ReceptionController;
use App\Http\Controllers\ResponsableController;
use App\Http\Controllers\RetourController;
use App\Http\Controllers\RubriqueController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\SuiviCommandeController;
use App\Http\Controllers\SuiviRapController;
use App\Http\Controllers\SuiviRubriqueController;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;

// ajax_controller
Route::middleware(['auth'])->group(function () {


    // commande_controller
    Route::resource('commandes' , RubriqueController::class)->except('show');
                  
    // livraison_controller                  
    Route::get('/livraisons/{commande}/edit',                        [LivraisonController::class, "edit"])->name("livraisons.edit");
    Route::put('/livraisons/{commande}',                             [LivraisonController::class, "update"])->name("livraisons.update");
                  
    // reception_controller                  
    Route::get('/receptions/{commande}/edit',                        [ReceptionController::class, "edit"])->name("receptions.edit");
    Route::put('/receptions/{commande}',                             [ReceptionController::class, "update"])->name("receptions.update");
                  
    // depot_controller                  
    Route::get('/depots/{commande}/edit',                            [DepotController::class, "edit"])->name("depots.edit");
    Route::put('/depots/{commande}',                                 [DepotController::class, "update"])->name("depots.update");
                  
    // paiement_controller                  
    Route::get('/paiements/{commande}/edit',                         [PaiementController::class, "edit"])->name("paiements.edit");
    Route::put('/paiements/{commande}',                              [PaiementController::class, "update"])->name("paiements.update");
                  
    // retour
    Route::get('/commandes/{commande}/retours/create',               [RetourController::class, "create"])->name("commandes.retours.create");
    Route::get('/commandes/{commande}/retours',                      [RetourController::class, "index"])->name("commandes.retours.index");
    Route::post('/commandes/{commande}/retours',                     [RetourController::class, "store"])->name("commandes.retours.store");

    // rubrique_controller
    Route::resource('rubriques' , RubriqueController::class)->except('show');

    // fournisseur
    Route::resource('fournisseurs' , RubriqueController::class)->except('show');

    // complexes
    Route::get('/complexes/create',                                  [ComplexeController::class, "create"])->name("complexes.create");
    Route::post('/complexes',                                        [ComplexeController::class, "store"])->name("complexes.store");
    Route::get('/complexes',                                         [ComplexeController::class, "index"])->name("complexes.index");
    Route::get('/complexes/{complexe}',                              [ComplexeController::class, "destroy"])->name("complexes.destroy");

    //efps
    Route::get('/complexes/{complexe}/efps/create',                  [EfpController::class, "create"])->name("complexes.efps.create");
    Route::get('/complexes/{complexe}/efps',                         [EfpController::class, "index"])->name("complexes.efps.index");
    Route::post('/complexes/{complexe}/efps',                        [EfpController::class, "store"])->name("complexes.efps.store");

    // suiviCommandes
    Route::get('/suiviCommandes',                                    [SuiviCommandeController::class, "index"])->name("suiviCommandes.index");

    // suiviRubriques
    Route::get('/suiviRubriques',                                    [SuiviRubriqueController::class, "index"])->name("suiviRubriques.index");

    // suiviRubriques
    Route::get('/suiviRaps',                                         [SuiviRapController::class, "index"])->name("suiviRaps.index");


    //views
    Route::view('/', "home");
});

// auth
Route::get('/login',                                                  [SessionController::class, "create"])->name('login');
Route::post('/logout',                                                [SessionController::class, "destroy"])->name('sessions.destroy');
Route::post('/login',                                                 [SessionController::class, "store"])->name('sessions.store');
