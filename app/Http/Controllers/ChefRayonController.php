<?php

namespace App\Http\Controllers;

use App\Models\Fiche;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\stock_Empl;
use App\Models\fiche_stock;
use App\Models\details_Fiche_Stock;
use App\Models\inventaire_stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Session;
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
        $list = DB::table('fiche_details_fiche')
            ->Where('etat', '=', 4)
            ->Where('AR_Design', 'like', '%' . $des . '%')
            ->groupBy('id_Fiche', 'AR_Ref', 'AR_Design', 'num_Lot', 'P_Intitule', 'date_controle', "quantite", 'position', 'etat', 'dt_Fiche_ref')
            ->select("id_Fiche", "AR_Ref", "AR_Design", "num_Lot", 'P_Intitule', "quantite", "date_controle", "Etat", "position", "dt_Fiche_ref");
        $val = $list->paginate(10);

        return view('chefRayon.ajaxliste-Fiches', ['val' => $val]);
    }

    public function ArtStockEmpl($id_dt_Fiche)
    {
        $DP_code = null;
        $reste = 0;
        $adresse = null;
        $details_Fiche = DB::table('details_FCPCC')
            ->Where('dt_Fiche_ref', '=', $id_dt_Fiche)
            ->groupBy(
                'AR_Ref',
                'AR_Design',
                'position',
                'quantite',
                'P_ref',
                'T_Stockage_ref',
                'volume',
                'poids',
                'P_Intitule',
                'date_peremp',
                'Type_Stockage',
                'etat',
                'num_Lot',
                'dt_Fiche_ref',
                'ANS',
                'MOIS',

            )
            ->select(
                'AR_Ref',
                'AR_Design',
                'position',
                'quantite',
                'P_ref',
                'T_Stockage_ref',
                'volume',
                'poids',
                'P_Intitule',
                'date_peremp',
                'Type_Stockage',
                'etat',
                'num_Lot',
                'dt_Fiche_ref',
                'ANS',
                'MOIS',

            )
            ->get();

        $ad = Session::get('DP_Code');
        if ($ad != null) {
            $DP_code = $ad;
        }

        $adr = DB::table('articles_Adresses')
            ->where('AR_Ref', '=', $details_Fiche[0]->AR_Ref)
            ->select('articles_Adresses.*')
            ->get();

        if(count($adr) > 0){
            $adresse = $adr;
        }

        $depot = DB::table('F_DEPOT')
            ->select('F_DEPOT.*')
            ->get();

        $dt_fiche_empl = DB::table('dt_fiche_stock')
            ->where('dt_Fiche_ref', '=', $id_dt_Fiche)
            ->select(DB::raw('sum(qte_sur_rack) as totalEnPlace'))
            ->get();
        if ($dt_fiche_empl == null) {
            $reste = $details_Fiche[0]->quantite;
        } elseif ($dt_fiche_empl != null) {
            $reste = $details_Fiche[0]->quantite - $dt_fiche_empl[0]->totalEnPlace;
        }
        if ($reste <= 0) {
            DB::update("update details_Fiche set etat = 5 where dt_Fiche_ref = " . $id_dt_Fiche);
            return redirect('/ChefRayon/fiches-nouveau')->withSuccess('Article mise en place');
        }

        return view('chefRayon.lot-mise-en-place', ['details' => $details_Fiche, 'adresse' => $adresse, 'DP_Code' => $DP_code, 'reste' => $reste, 'depot' => $depot]);
    }

    public function ajaxListeAdresses(Request $request)
    {
        $des = $request->filtre;
        $dt_Fiche_ref = $request->dt_Fiche_ref;
        $adresse = DB::table('articles_Adresses')
            ->orWhere('DP_Code', 'like', '%' . $des . '%')
            ->orWhere('DP_Intitule', 'like', '%' . $des . '%')
            ->orWhere('AR_Ref', 'like', '%' . $des . '%')
            ->select('articles_Adresses.*');
        $val = $adresse->paginate(10);
        return view('chefRayon.ajaxliste-Adresses', ['val' => $val, 'dt_Fiche_ref' => $dt_Fiche_ref]);
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
        $idFS = null;


        $id_Fiche_Stock = DB::table('fiche_stock')
            ->where('dt_Fiche_ref', '=', $dt_Fiche_ref)
            ->select('fiche_stock.*')
            ->get();


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
        $list = DB::table('dt_fiche_stock')
            ->orWhere('AR_Design', 'like', '%' . $des . '%')
            ->orWhere('AR_Ref', 'like', '%' . $des . '%')
            ->orWhere('num_Lot', 'like', '%' . $des . '%')
            ->groupBy(
                'id_fiche_stock',
                'AR_Ref',
                'AR_Design',
                'quantite',
                'P_Intitule',
                'date_peremp',
                'num_Lot',
                'dt_Fiche_ref',
                'DE_Intitule'
            )
            ->select(
                'id_fiche_stock',
                'AR_Ref',
                'AR_Design',
                'quantite',
                'P_Intitule',
                'date_peremp',
                'num_Lot',
                'dt_Fiche_ref',
                DB::raw('sum(qte_sur_rack) as total'),
                'DE_Intitule'
            );
        $val = $list->paginate(10);

        return view('chefRayon.ajaxliste-Fiches-Stock', ['val' => $val]);
    }

    public function dtFicheStock($id_fiche_stock)
    {

        $num_rack = null;
        $id_empl = null;
        $CT_Num = null;
        $details = DB::table('dt_fiche_stock')
            ->where('id_fiche_stock', "=", $id_fiche_stock)
            ->select('dt_fiche_stock.*')
            ->get();

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
            $CT_Num = DB::table('F_COMPTET')
                ->Where("CT_Num", "=", $frns_clt)
                ->select('F_COMPTET.*')
                ->get();
        }

        return view('chefRayon.details-Fiche-Stock', ['details' => $details, 'num_rack' => $num_rack, 'CT_Num' => $CT_Num, 'id_empl' => $id_empl]);
    }

    public function ajaxListeStockEmpl(Request $request)
    {
        $des = $request->designation;
        $id_fiche_stock = $request->idFiche_Stock;
        $stock_empl = DB::table('dt_fiche_stock')
            ->Where('num_Rack', 'like', '%' . $des . '%')
            ->Where('id_fiche_stock', 'like', '%' . $id_fiche_stock . '%')
            ->select('dt_fiche_stock.*', DB::raw('(SELECT (sum([entree]))-(sum([sortie]))
  FROM [reception_salama].[dbo].[details_Fiche_Stock] q  where [id_stock_empl] = dt_fiche_stock.id_stock_Empl GROUP BY [id_stock_empl]) as Reste'));
        $val = $stock_empl->paginate(10);
        return view('chefRayon.ajaxliste-stock-empl', ['val' => $val]);
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
        $F_COMPTET = DB::table('F_COMPTET')
            ->Where('CT_Intitule', 'like', '%' . $name . '%')
            ->Where('CT_Type', '=', $type)
            ->select('F_COMPTET.*');
        $val = $F_COMPTET->paginate(10);
        return view('chefRayon.ajaxliste-frns-client', ['val' => $val, 'id_fiche_stock' => $idF]);
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
            inventaire_stock::create([
                'id_fiche_stock' => $idFS,
                'quantite' => $quantite,
                'date_inventaire' => $date,
                'observations' => $observations,
            ]);

            return redirect('/fiche/stock/details/' . $idFS)->withSuccess('Mouvement stock enregistrer');
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
            $mvt_stock = DB::table('mvt_stock')
                ->orderByRaw('date_mvt ASC')
                ->where('id_fiche_stock', '=', $idFicheStock)
                ->where('date_mvt', '>=', $debut)
                ->where('date_mvt', '<=', $fin)
                ->select('mvt_stock.*', DB::raw('sum(entree-sortie) OVER (ORDER BY date_mvt,id_stock_empl asc) as stock'));
        } else {
            $mvt_stock = DB::table('mvt_stock')
                ->orderByRaw('date_mvt ASC')
                ->where('id_fiche_stock', '=', $idFicheStock)
                ->select('mvt_stock.*', DB::raw('sum(entree-sortie) OVER (ORDER BY date_mvt,id_stock_empl asc) as stock'));
        }

        $list_mvt_stock = $mvt_stock->paginate(10);

        return view('chefRayon.ajax-report', ['mvt_stock' => $list_mvt_stock]);
    }

    public function genererPDF(Request $request)
    {
        $id_fiche_stock = $request->idFicheStock;
        $debut = $request->searchBarDateDebut;
        $fin = $request->searchBarDateFin;
        if ($debut != null && $fin != null) {
            $list = DB::table('mvt_stock')
                ->orderByRaw('date_mvt ASC')
                ->where('id_fiche_stock', '=', $id_fiche_stock)
                ->where('date_mvt', '>=', $debut)
                ->where('date_mvt', '<=', $fin)
                ->select('mvt_stock.*', DB::raw('sum(entree-sortie) OVER (ORDER BY date_mvt,id_stock_empl asc) as stock'))
                ->get();
        } else {
            $list = DB::table('mvt_stock')
                ->orderByRaw('date_mvt ASC')
                ->where('id_fiche_stock', '=', $id_fiche_stock)
                ->select('mvt_stock.*', DB::raw('sum(entree-sortie) OVER (ORDER BY date_mvt,id_stock_empl asc) as stock'))
                ->get();
        }
        $details = DB::table('dt_fiche_stock')
            ->where('id_fiche_stock', "=", $id_fiche_stock)
            ->select('dt_fiche_stock.*')
            ->get();

        $pdf = PDF::setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
            'defaultFont' => 'sans-serif'
        ])->loadView('chefRayon.fiche_Stock_PDF', ['val' => $list, 'details' => $details]);
        return $pdf->download('fiche_de_stock_n°' . $list[0]->id_fiche_stock . '.pdf');
    }
}
    