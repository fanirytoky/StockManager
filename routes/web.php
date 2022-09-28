<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\pdfController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApproController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\ChefRayonController;
use App\Http\Controllers\MagasinierController;
use App\Http\Controllers\PharmacienController;

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
    return view('auth.login');
});
Route::get('/home',[Controller::class,'index'])->name('home');
Route::get('/Fiches',[Controller::class,'listeFichesPage'])->name('fiches');
Route::get('/AjaxListeFiche/All',[Controller::class,'listeFiches'])->name('fiches.liste.all');


// Admin
Route::get('/create.user',[AdminController::class,'createUser'])->name('user.Create')->middleware(['Admin']);
Route::post('/create-user',[AdminController::class,'storeUser'])->name('user.Store')->middleware(['Admin']);
Route::get('/users',[AdminController::class,'users'])->name('users')->middleware(['Admin']);
Route::get('/AjaxListeUser',[AdminController::class,'ajaxListeUser'])->name('ajax.listeUser')->middleware(['Admin']);
Route::get('/user/{id}',[AdminController::class,'updateUser'])->name('user.update')->middleware(['Admin']);
Route::post('/user.set',[AdminController::class,'modifierUser'])->name('modifUser')->middleware(['Admin']);
Route::get('/users/{id}',[AdminController::class,'deleteUser'])->name('user.delete')->middleware(['Admin']);
// 

// Magasinier
Route::get('/fiche-create',[MagasinierController::class,'createFiche'])->name('fiche.create')->middleware(['Magasinier']);
Route::get('/fiches',[MagasinierController::class,'fiches'])->name('fiche.list')->middleware(['Magasinier']);
Route::get('/AjaxListeFiche',[MagasinierController::class,'AjaxListeFiche'])->name('AjaxListeFiche')->middleware(['Magasinier']);
Route::post('/fiche-ajout',[MagasinierController::class,'storeFiche'])->name('fiche.Store')->middleware(['Magasinier']);
Route::get('/articles',[MagasinierController::class,'ajaxListeArticle'])->name('ajax.listeArticles')->middleware(['Magasinier']);
Route::get('/article/{AR_ref}',[MagasinierController::class,'setSession'])->name('setSession')->middleware(['Magasinier']);
Route::get('/fournisseurs',[MagasinierController::class,'ajaxListeFrns'])->name('ajax.listeFrns')->middleware(['Magasinier']);
Route::get('/fournisseur/{CT_Num}',[MagasinierController::class,'setSessionFrns'])->name('setSessionFournisseur')->middleware(['Magasinier']);
Route::get('/mot.split/{mot}',[MagasinierController::class,'split'])->name('split')->middleware(['Magasinier']);
Route::get('/fiche-ajout-lot/{id_Fiche}',[MagasinierController::class,'ajoutLot'])->name('fiche.ajoutLot')->middleware(['Magasinier']);
Route::get('/fiche-valider/{id_Fiche}',[MagasinierController::class,'validerFiche'])->name('fiche.valider')->middleware(['Magasinier']);
Route::get('/articles-adresses',[MagasinierController::class,'listAdresse'])->name('article.adresse')->middleware(['Magasinier']);
Route::get('Magasinier/adresses',[MagasinierController::class,'ajaxListeAdresses'])->name('Magasinier/ajax.listeAdresses')->middleware(['Magasinier']);


// 

// Resp Approvisionnement
Route::get('/fiches-nouveau',[ApproController::class,'listeNewFiche'])->name('fiche.new')->middleware(['Appro']);
Route::get('/AjaxListeFiche.new',[ApproController::class,'AjaxListeFiche'])->name('AjaxListeFiche.new')->middleware(['Appro']);
Route::get('/fiche-referenciee/{id_Fiche}',[ApproController::class,'referenceFiche'])->name('referencier.fiche')->middleware(['Appro']);
Route::get('/fournisseurs-references',[ApproController::class,'ajaxListeFrns'])->name('ajax.listeFrns')->middleware(['Appro']);
Route::get('/frns/{CT_Num}/{id_Fiche}',[ApproController::class,'setSessionFrns'])->name('setSessionFrns')->middleware(['Appro']);
Route::post('/fiche-ajout-reference',[ApproController::class,'storeReference'])->name('reference.Store')->middleware(['Appro']);
Route::get('/Appro/Chart/Vue',[ApproController::class,'tauxActiviteFrnsPage'])->name('Appro.chart.vue')->middleware(['Appro']);
Route::get('/Appro/Chart',[ApproController::class,'tauxActiviteFrns'])->name('Appro.chart')->middleware(['Appro']);

// 

// Pharmacien Responsable
Route::get('/Pharmacien/fiches-nouveau',[PharmacienController::class,'listeNewFiche'])->name('Pharma/fiche.new')->middleware(['Pharmacien']);
Route::get('/Pharmacien/AjaxListeFiche.new',[PharmacienController::class,'AjaxListeFiche'])->name('Pharma/AjaxListeFiche.new')->middleware(['Pharmacien']);
Route::get('/fiche-details-score/{id_dt_Fiche}',[PharmacienController::class,'detailsFiche'])->name('Pharma/fiche-details')->middleware(['Pharmacien']);
Route::post('/fiche-ajout-score',[PharmacienController::class,'storeScore'])->name('score.Store')->middleware(['Pharmacien']);
Route::post('/fiche-ajout-scores',[PharmacienController::class,'storeScores'])->name('score2.Store')->middleware(['Pharmacien']);
Route::post('/fiche-decision',[PharmacienController::class,'decisionFiche'])->name('Pharma/fiche.decision')->middleware(['Pharmacien']);
Route::get('/fiche-modifier/{id_Fiche}',[PharmacienController::class,'editFiche'])->name('Pharma/fiche-edit')->middleware(['Pharmacien']);
Route::post('/fiche-modifier',[PharmacienController::class,'updateFiche'])->name('Pharma/fiche.update')->middleware(['Pharmacien']);
Route::get('/Pharmacien/fiches-attente',[PharmacienController::class,'listeFicheAttente'])->name('Pharma/fiche.attente')->middleware(['Pharmacien']);
Route::get('/Pharmacien/AjaxListeFiche.attente',[PharmacienController::class,'AjaxListeFicheAttente'])->name('Pharma/AjaxListeFiche.attente')->middleware(['Pharmacien']);
Route::get('/Pharmacien/fiches-rebut',[PharmacienController::class,'listeFicheRebut'])->name('Pharma/fiche.rebut')->middleware(['Pharmacien']);
Route::get('/Pharmacien/AjaxListeFiche.rebut',[PharmacienController::class,'AjaxListeFicheRebut'])->name('Pharma/AjaxListeFiche.rebut')->middleware(['Pharmacien']);
Route::get('/Pharmacien/Chart/Vue',[PharmacienController::class,'scoreQualiteFrnsPage'])->name('Pharmacien.chart.vue')->middleware(['Pharmacien']);
Route::get('/Pharmacien/Chart',[PharmacienController::class,'scoreQualiteFrns'])->name('Pharmacien.chart')->middleware(['Pharmacien']);
Route::get('/Article-expiration/Chart',[PharmacienController::class,'detailsChartTri'])->name('Pharmacien.chart.details')->middleware(['Pharmacien']);

// 

// Responsable Stock
Route::get('/Stock/fiches-nouveau',[StockController::class,'listeNewFiche'])->name('Stock/fiche.new')->middleware(['Stock']);
Route::get('/Stock/AjaxListeFiche.new',[StockController::class,'AjaxListeFiche'])->name('Stock/AjaxListeFiche.new')->middleware(['Stock']);
Route::get('/fiche-pdf/{dt_Fiche}',[StockController::class,'genererPDF'])->name('Stock/fiche-PDF');
Route::get('/reception/calendrier',[StockController::class,'calendar'])->name('calendar')->middleware(['Stock']);
Route::get('/reception-detail',[StockController::class,'ficheInfo'])->name('detail.fiche')->middleware(['Stock']);
Route::get('/Stock/fiches-attente',[StockController::class,'listeFicheAttente'])->name('Stock/fiche.attente')->middleware(['Stock']);
Route::get('/Stock/AjaxListeFiche.attente',[StockController::class,'AjaxListeFicheAttente'])->name('Stock/AjaxListeFiche.attente')->middleware(['Stock']);
Route::get('/Stock/fiche-details/{id_dt_Fiche}',[StockController::class,'detailsFiche'])->name('Stock/fiche-details')->middleware(['Stock']);
Route::get('/fiche-save/{dt_Fiche_ref}',[StockController::class,'enregistrerFiche'])->name('Stock/fiche.decision')->middleware(['Stock']);

//

// Chef de Rayon
Route::get('/ChefRayon/fiches-nouveau',[ChefRayonController::class,'listeNewFiche'])->name('ChefRayon/fiche.new')->middleware(['ChefRayon']);
Route::get('/ChefRayon/AjaxListeFiche.new',[ChefRayonController::class,'AjaxListeFiche'])->name('ChefRayon/AjaxListeFiche.new')->middleware(['ChefRayon']);
Route::get('/Article-emplacement/{id_dt_Fiche}',[ChefRayonController::class,'ArtStockEmpl'])->name('ChefRayon/fiche-emplacement')->middleware(['ChefRayon']);
Route::get('/adresses',[ChefRayonController::class,'ajaxListeAdresses'])->name('ajax.listeAdresses')->middleware(['ChefRayon']);
Route::get('/adresse/{DP_Code}/{dt_Fiche_ref}',[ChefRayonController::class,'setSession'])->name('ChefRayon/lot-emplacement')->middleware(['ChefRayon']);
Route::post('/emplacement-ajout',[ChefRayonController::class,'storeEmplacement'])->name('emplacement.Store')->middleware(['ChefRayon']);
Route::get('/ChefRayon/fiches-stock',[ChefRayonController::class,'listeFicheStock'])->name('ChefRayon/fiche.stock')->middleware(['ChefRayon']);
Route::get('/ChefRayon/AjaxListeFiche.stock',[ChefRayonController::class,'AjaxListeFicheStock'])->name('ChefRayon/AjaxListeFiche.stock')->middleware(['ChefRayon']);
Route::get('/fiche/stock/details/{id_fiche_stock}',[ChefRayonController::class,'dtFicheStock'])->name('ChefRayon/fiche-stock-details')->middleware(['ChefRayon']);
Route::get('/stock-emplacement',[ChefRayonController::class,'ajaxListeStockEmpl'])->name('ajax.listeStockEmpl')->middleware(['ChefRayon']);
Route::get('/setSessionNumRack/{num_Rack}/{id_fiche_stock}/{id_stock_Empl}',[ChefRayonController::class,'setSessionNumRack'])->name('setSessionNumRack')->middleware(['ChefRayon']);
Route::get('/frns/client',[ChefRayonController::class,'ajaxListeFrnsClient'])->name('ajax.listeFrnsClient')->middleware(['ChefRayon']);
Route::get('/setSessionFrnsClient/{CT_Num}/{id_fiche_stock}',[ChefRayonController::class,'setSessionFrnsClient'])->name('setSessionFrnsClient')->middleware(['ChefRayon']);
Route::post('/Mouvement-Stock-ajout',[ChefRayonController::class,'storeMvtStock'])->name('mvtFicheStock.Store')->middleware(['ChefRayon']);
Route::get('/stock-report',[ChefRayonController::class,'ajaxReport'])->name('ajax-report')->middleware(['ChefRayon']);
Route::post('/fiche-stock-pdf',[ChefRayonController::class,'genererPDF'])->name('fiche_stock.PDF')->middleware(['ChefRayon']);
Route::get('/stock/ajuster/{inventaire}/{stock}/{id_stock_empl}',[ChefRayonController::class,'ajusterStockInventaire'])->name('stock/ajuster')->middleware(['ChefRayon']);
Route::get('/Mouvement-Stock/Chart/Vue',[ChefRayonController::class,'mvtStockStatPage'])->name('ChefRayon.chart.vue')->middleware(['ChefRayon']);
Route::get('/Mouvement-Stock/Chart',[ChefRayonController::class,'mvtStockStat'])->name('ChefRayon.chart')->middleware(['ChefRayon']);
Route::get('/fiche-filtre/Chart',[ChefRayonController::class,'ficheFiltre'])->name('ChefRayon.chart.filtre')->middleware(['ChefRayon']);
// 



require __DIR__.'/auth.php';
