<?php

use App\Http\Controllers\AppelOffreController;
use App\Http\Controllers\BonCommandeController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\ComplexeController;
use App\Http\Controllers\DepotController;
use App\Http\Controllers\EfpController;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\LivraisonController;
use App\Http\Controllers\MarcheController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\ReceptionController;
use App\Http\Controllers\RetourController;
use App\Http\Controllers\BonRetourController;
use App\Http\Controllers\RubriqueController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\SuiviCommandeController;
use App\Http\Controllers\SuiviRapController;
use App\Http\Controllers\SuiviRubriqueController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    // commande
    Route::resource('commandes', CommandeController::class)->except('show');
    // bon_commande
    Route::resource('bonCommandes', BonCommandeController::class)->except('show');

    // livraison                  
    Route::get('/livraisons/{commande}/edit',                        [LivraisonController::class, "edit"])->name("livraisons.edit");
    Route::put('/livraisons/{commande}',                             [LivraisonController::class, "update"])->name("livraisons.update");

    // reception                  
    Route::get('/receptions/{commande}/edit',                        [ReceptionController::class, "edit"])->name("receptions.edit");
    Route::put('/receptions/{commande}',                             [ReceptionController::class, "update"])->name("receptions.update");

    // depot                  
    Route::get('/depots/{commande}/edit',                            [DepotController::class, "edit"])->name("depots.edit");
    Route::put('/depots/{commande}',                                 [DepotController::class, "update"])->name("depots.update");

    // paiement                  
    Route::get('/paiements/{commande}/edit',                         [PaiementController::class, "edit"])->name("paiements.edit");
    Route::put('/paiements/{commande}',                              [PaiementController::class, "update"])->name("paiements.update");

    // retour
    Route::get('/commandes/{commande}/retours',                      [RetourController::class, "index"])->name("commandes.retours.index");
    Route::get('/commandes/{commande}/retours/create',               [RetourController::class, "create"])->name("commandes.retours.create");
    Route::post('/commandes/{commande}/retours',                     [RetourController::class, "store"])->name("commandes.retours.store");
    Route::get('/retours/{retour}/edit',                      [RetourController::class, "edit"])->name("retours.edit");
    Route::put('/retours/{retour}',                      [RetourController::class, "update"])->name("retours.update");
    Route::delete('/retours/{retour}',                      [RetourController::class, "destroy"])->name("retours.destroy");

    //bon_retour
    Route::get('/bonCommandes/{bonCommande}/bonRetours',                      [BonRetourController::class, "index"])->name("bonCommandes.bonRetours.index");
    Route::get('/bonCommandes/{bonCommande}/bonRetours/create',               [BonRetourController::class, "create"])->name("bonCommandes.bonRetours.create");
    Route::post('/bonCommandes/{bonCommande}/bonRetours',                     [BonRetourController::class, "store"])->name("bonCommandes.bonRetours.store");
    Route::get('/bonRetours/{bonRetour}/edit',                      [BonRetourController::class, "edit"])->name("bonRetours.edit");
    Route::put('/bonRetours/{bonRetour}',                      [BonRetourController::class, "update"])->name("bonRetours.update");

    // rubrique
    Route::resource('rubriques', RubriqueController::class)->except('show');

    // fournisseur
    Route::resource('fournisseurs', FournisseurController::class)->except('show');

    // complexes
    Route::resource('complexes', ComplexeController::class)->except('show');

    //efps
    Route::get('/complexes/{complexe}/efps',                         [EfpController::class, "index"])->name("complexes.efps.index");
    Route::get('/complexes/{complexe}/efps/create',                  [EfpController::class, "create"])->name("complexes.efps.create");
    Route::post('/complexes/{complexe}/efps',                        [EfpController::class, "store"])->name("complexes.efps.store");
    Route::get('/efps/{efp}/edit',                        [EfpController::class, "edit"])->name("efps.edit");
    Route::put('/efps/{efp}',                        [EfpController::class, "update"])->name("efps.update");
    Route::delete('/efps/{efp}',                        [EfpController::class, "destroy"])->name("efps.destroy");

    // suiviCommandes
    Route::get('/suiviCommandes',                                    [SuiviCommandeController::class, "index"])->name("suiviCommandes.index");

    // suiviRubriques
    Route::get('/suiviRubriques',                                    [SuiviRubriqueController::class, "index"])->name("suiviRubriques.index");

    // suiviRubriques
    Route::get('/suiviRaps',                                         [SuiviRapController::class, "index"])->name("suiviRaps.index");
    // users
    Route::get('/users/create',                                       [UserController::class, "create"])->can("add-users")->name("users.create");
    Route::post('/users',                                       [UserController::class, "store"])->can("add-users")->name("users.store");

    // appel offre
    Route::resource('appelOffres', AppelOffreController::class)->except(['show', 'edit', 'update']);

    // marche
    Route::get('/appelOffres/{appeloffre}/marches', [MarcheController::class, 'index'])->name('appelOffres.marches.index');
    Route::get('/appelOffres/{appelOffres}/marches/create', [MarcheController::class, 'create'])->name('appelOffres.marches.create');
    Route::post('/appelOffres/{appelOffres}/marches', [MarcheController::class, 'store'])->name('appelOffres.marches.store');
    Route::get('/marches/{marche}/edit', [MarcheController::class, 'edit'])->name('marches.edit');
    Route::put('/marches/{marche}', [MarcheController::class, 'update'])->name('marches.update');
    Route::delete('/marches/{marche}', [MarcheController::class, 'destroy'])->name('marches.destroy');

    //views
    Route::view('/', "home")->name('home');
});

// auth
Route::get('/login',                                                  [SessionController::class, "create"])->name('login');
Route::post('/logout',                                                [SessionController::class, "destroy"])->name('sessions.destroy');
Route::post('/login',                                                 [SessionController::class, "store"])->name('sessions.store');
