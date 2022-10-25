<?php

namespace App\Http\Controllers;

use App\Models\Depot;
use App\Models\Fiche;
use App\Models\mvt_Stock;
use App\Models\stock_Empl;
use App\Models\fiche_stock;
use App\Models\Fournisseur;
use Illuminate\Http\Request;
use App\Models\Details_FCPCC;
use App\Models\Details_Fiche;
use App\Models\Article_Adresse;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\inventaire_stock;
use Illuminate\Support\Facades\DB;
use App\Models\details_Fiche_Stock;
use App\Models\dt_Fiche_Stock_Empl;
use App\Models\Fiche_Details_Fiche;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ChefRayonController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function listeNewFiche()
    {
        return view('chefRayon.liste-Intrants-non-en-place');
    }

    public function AjaxListeFiche(Request $request)
    {
        $des = $request->filtre;
        $list = Fiche_Details_Fiche::getFicheAPlacer($des, 4);

        return view('chefRayon.ajaxliste-Fiches', ['val' => $list]);
    }

    public function ArtStockEmpl($id_dt_Fiche)
    {
        $DP_code = null;
        $reste = 0;
        $adresse = null;
        $details_Fiche = Details_FCPCC::getStockDetails($id_dt_Fiche);

        $ad = Session::get('DP_Code');
        if ($ad != null) {
            $DP_code = $ad;
        }

        $adr = Article_Adresse::getAdresseByRef($details_Fiche[0]->AR_Ref);

        if (count($adr) > 0) {
            $adresse = $adr;
        }

        $depot = Depot::all();

        $dt_fiche_empl = dt_Fiche_Stock_Empl::getTotalEnPlace($id_dt_Fiche);
        if ($dt_fiche_empl == null) {
            $reste = $details_Fiche[0]->quantite;
        } elseif ($dt_fiche_empl != null) {
            $reste = $details_Fiche[0]->quantite - $dt_fiche_empl[0]->totalEnPlace;
        }
        if ($reste <= 0) {
            Details_Fiche::validerDtFiche($id_dt_Fiche, 5);
            return redirect('/ChefRayon/fiches-nouveau')->withSuccess('Article mise en place');
        }

        return view('chefRayon.lot-mise-en-place', ['details' => $details_Fiche, 'adresse' => $adresse, 'DP_Code' => $DP_code, 'reste' => $reste, 'depot' => $depot]);
    }

    public function ajaxListeAdresses(Request $request)
    {
        $des = $request->filtre;
        $dt_Fiche_ref = $request->dt_Fiche_ref;
        $adresse = Article_Adresse::getListArtAdresse($des);
        return view('chefRayon.ajaxliste-Adresses', ['val' => $adresse, 'dt_Fiche_ref' => $dt_Fiche_ref]);
    }

    public function setSession($DP_Code, $dt_Fiche_ref)
    {
        $value = $DP_Code;
        Session::put('DP_Code', $value);
        return redirect('/Article-emplacement/' . $dt_Fiche_ref);
    }


    public function storeEmplacement(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'num_rack' => ['required'],
                'quantite' => ['required'],
            ],
            [
                'num_rack.required' => "Veuillez  remplir l'adresse",
                'quantite.required' => 'Veuillez  remplir la quantite',
            ]
        );

        if ($validator->fails()) {
            return  redirect()->back()->withErrors($validator)->withInput();
        }

        $num_rack = $request->num_rack;
        $dt_Fiche_ref = $request->dt_Fiche_ref;
        $quantite = $request->quantite;
        $observation = $request->observation;
        $DE_No = $request->DE_No;
        $idF = null;
        $fiche_Stock = null;

        $id_Fiche_Stock = fiche_stock::getFicheStockById($dt_Fiche_ref);

        if (count($id_Fiche_Stock) == 0) {
            $fiche_Stock = fiche_stock::create([
                'date' => now(),
                'dt_Fiche_ref' => $dt_Fiche_ref,
                'DE_No' => $DE_No,
            ]);
            $idF = $fiche_Stock->id;
        } else {
            $idF = $id_Fiche_Stock[0]->id_fiche_stock;
        }

        $id_stock_emplacement = stock_Empl::create([
            'id_fiche_stock' => $idF,
            'num_Rack' => $num_rack,
            'quantite' => $quantite,
            'Date' => now(),
            'observation' => $observation,
        ]);

        details_Fiche_Stock::create([
            'id_stock_empl' => $id_stock_emplacement->id,
            'entree' => $quantite,
            'sortie' => 0,
            'observation' => $observation,
            'date' => now(),
            'id_user' => auth()->user()->id,
        ]);

        return redirect('/Article-emplacement/' . $dt_Fiche_ref)->withSuccess('Emplacement enregistrer');
    }

    public function listeFicheStock()
    {
        return view('chefRayon.liste-fiche-stock');
    }

    public function AjaxListeFicheStock(Request $request)
    {
        $des = $request->filtre;
        $list = dt_Fiche_Stock_Empl::getFicheStock($des);

        return view('chefRayon.ajaxliste-Fiches-Stock', ['val' => $list]);
    }

    public function dtFicheStock($id_fiche_stock)
    {

        $num_rack = null;
        $id_empl = null;
        $CT_Num = null;
        $details = dt_Fiche_Stock_Empl::getDtFichStockById($id_fiche_stock);

        $num = Session::get('num_Rack');
        if ($num != null) {
            $num_rack = $num;
        }
        $id_e = Session::get('id_stock_Empl');
        if ($id_e != null) {
            $id_empl = $id_e;
        }
        $frns_clt = Session::get('CT_Num');
        if ($frns_clt != null) {
            $CT_Num = Fournisseur::getFrns($frns_clt);
        }

        return view('chefRayon.details-Fiche-Stock', ['details' => $details, 'num_rack' => $num_rack, 'CT_Num' => $CT_Num, 'id_empl' => $id_empl]);
    }

    public function ajaxListeStockEmpl(Request $request)
    {
        $des = $request->designation;
        $id_fiche_stock = $request->idFiche_Stock;
        $stock_empl = dt_Fiche_Stock_Empl::getStockEmplacement($des, $id_fiche_stock);
        return view('chefRayon.ajaxliste-stock-empl', ['val' => $stock_empl]);
    }

    public function setSessionNumRack($num_Rack, $id_fiche_stock, $id_stock_Empl)
    {
        Session::forget('num_Rack');
        Session::forget('CT_Num');
        Session::forget('id_fiche_stock');
        Session::put('num_Rack', $num_Rack);
        Session::put('id_stock_Empl', $id_stock_Empl);
        return redirect('/fiche/stock/details/' . $id_fiche_stock);
    }

    public function ajaxListeFrnsClient(Request $request)
    {
        $name = $request->CT_Intitule;
        $type = $request->CT_Type;
        $idF = $request->idFiche_Stock;
        $F_COMPTET = Fournisseur::getListeFrns($name, $type);
        return view('chefRayon.ajaxliste-frns-client', ['val' => $F_COMPTET, 'id_fiche_stock' => $idF]);
    }

    public function setSessionFrnsClient($CT_Num, $id_fiche_stock)
    {
        Session::forget('CT_Num');
        Session::forget('id_fiche_stock');
        Session::put('CT_Num', $CT_Num);
        Session::put('id_fiche_stock', $id_fiche_stock);
        return redirect('/fiche/stock/details/' . $id_fiche_stock);
    }

    public function storeMvtStock(Request $request)
    {
        $type_mvt = $request->type_mvt;
        if ($type_mvt == 2) {
            $idFS = $request->idFS;
            $quantite = $request->quantite;
            $date = $request->date;
            $observations = $request->observations;

            $validator = Validator::make(
                $request->all(),
                [
                    'quantite' => ['required'],
                    'date' => ['date'],
                ],
                [
                    'quantite.required' => 'Veuillez  remplir la quantite',
                    'date.required' => 'Veuillez  remplir la date',
                ]
            );

            if ($validator->fails()) {
                return  redirect()->back()->withErrors($validator)->withInput();
            }

            $lastDate = mvt_Stock::getLastDateMvtStock($idFS);
            if ($lastDate[0]->max > $date) {
                return  redirect()->back()->withErrors('inventaire invalide');
            } else {


                inventaire_stock::create([
                    'id_fiche_stock' => $idFS,
                    'quantite' => $quantite,
                    'date_inventaire' => $date,
                    'observations' => $observations,
                ]);
            }

            return redirect('/fiche/stock/details/' . $idFS)->withSuccess('Mouvement stock enregistré');
        } else {


            $validator = Validator::make(
                $request->all(),
                [
                    'id_stock_empl' => ['required'],
                    'CT_Num' => ['required'],
                    'num_doc' => ['required'],
                    'quantite' => ['required'],
                    'date' => ['date'],
                ],
                [
                    'id_stock_empl.required' => "Veuillez  choisir le numéro du rack",
                    'CT_Num.required' => "Veuillez  remplir le fournisseur ou le client",
                    'num_doc.required' => "Veuillez  remplir le numéro du document",
                    'quantite.required' => 'Veuillez  remplir la quantite',
                    'date.required' => 'Veuillez  remplir la date',
                ]
            );

            if ($validator->fails()) {
                return  redirect()->back()->withErrors($validator)->withInput();
            }
            $idFS = $request->idFS;
            $id_stock_empl = $request->id_stock_empl;
            $CT_Num = $request->CT_Num;
            $num_doc = $request->num_doc;
            $quantite = $request->quantite;
            $date = $request->date;
            $observations = $request->observations;
            $entree = 0;
            $sortie = 0;

            if ($type_mvt == 0) {
                $entree = $quantite;
            }
            if ($type_mvt == 1) {
                $sortie = $quantite;
            }

            details_Fiche_Stock::create([
                'id_stock_empl' => $id_stock_empl,
                'CT_Num' => $CT_Num,
                'num_Doc' => $num_doc,
                'entree' => $entree,
                'sortie' => $sortie,
                'observation' => $observations,
                'date' => $date,
                'id_user' => auth()->user()->id,
            ]);


            return redirect('/fiche/stock/details/' . $idFS)->withSuccess('Mouvement stock enregistrer');
        }
    }

    public function ajaxReport(Request $request)
    {
        $debut = $request->debut;
        $fin = $request->fin;
        $idFicheStock = $request->idFicheStock;

        if ($debut != null && $fin != null) {
            $mvt_stock = mvt_Stock::getMvtStockEntreDeuxDates($debut, $fin, $idFicheStock);
            $list_mvt_stock = mvt_Stock::paginate($mvt_stock);
        } else {
            $mvt_stock = mvt_Stock::getMvtStock($idFicheStock);
            $list_mvt_stock = mvt_Stock::paginate($mvt_stock);
        }

        return view('chefRayon.ajax-report', ['mvt_stock' => $list_mvt_stock]);
    }

    public function genererPDF(Request $request)
    {
        $id_fiche_stock = $request->idFicheStock;
        $debut = $request->searchBarDateDebut;
        $fin = $request->searchBarDateFin;
        if ($debut != null && $fin != null) {
            $list = mvt_Stock::getMvtStockEntreDeuxDates($debut, $fin, $id_fiche_stock);
        } else {
            $list = mvt_Stock::getMvtStock($id_fiche_stock);
        }
        $details = dt_Fiche_Stock_Empl::getDtFichStockById($id_fiche_stock);

        $pdf = PDF::setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
            'defaultFont' => 'sans-serif'
        ])->loadView('chefRayon.fiche_Stock_PDF', ['val' => $list, 'details' => $details]);
        return $pdf->download('fiche_de_stock_n°' . $id_fiche_stock . '.pdf');
    }

    public function ajusterStockInventaire($inventaire, $stock, $id_stock_empl, $id_inventaire)
    {
        $entree = 0;
        $sortie = 0;
        if ($inventaire < $stock) {
            $sortie = ($stock - $inventaire);
            $observations = "Stock en plus";
        }
        if ($stock < $inventaire) {
            $entree = ($inventaire - $stock);
            $observations = "Stock en manque";
        }

        details_Fiche_Stock::create([
            'id_stock_empl' => $id_stock_empl,
            'entree' => $entree,
            'sortie' => $sortie,
            'observation' => $observations,
            'date' => now(),
            'id_user' => auth()->user()->id,
        ]);

        inventaire_stock::updateEtatInventaire($id_inventaire, 1);

        return Redirect::back()->withErrors(['msg' => 'Ajustement stock enregistrer']);
    }


    // public function ficheFiltre(Request $request)
    // {
    //     $filtre = $request->filtre;
    //     $res = mvt_Stock::ficheFiltre($filtre);
    //     $dt = [];
    //     $id = [];
    //     foreach ($res as $data) {
    //         $dt[] = $data->des;
    //         $id[] = $data->id_Fiche;
    //     }
    //     return response()->json([
    //         'designation' => $dt,
    //         'id_Fiche' => $id
    //     ]);
    // }
}
