<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class StockController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function listeNewFiche()
    {
        return view('respStock.listeFicheAvalider');
    }

    public function AjaxListeFiche(Request $request)
    {
        $des = $request->filtre;
        $list = DB::table('fiche_details_fiche')
            ->Where('AR_Design', 'like', '%' . $des . '%')
            ->Where('etat', '=', 3)
            ->orWhere('etat', '=', 4)
            ->orWhere('etat', '=', 5)
            ->groupBy('id_Fiche', 'AR_Ref', 'AR_Design', 'CT_Intitule', 'date_controle', 'position', 'etat', 'dt_Fiche_ref')
            ->select("id_Fiche", "AR_Ref", "AR_Design", "CT_Intitule", DB::raw("sum(quantite) as total"), "date_controle", "Etat", "position", "dt_Fiche_ref");
        $val = $list->paginate(10);

        return view('respStock.ajaxliste-Fiches', ['val' => $val]);
    }

    public function genererPDF($dt_Fiche)
    {
        $etat = DB::table('details_Fiche')
            ->Where('dt_Fiche_ref', '=', $dt_Fiche)
            ->select('details_Fiche.etat')
            ->get();
        $list = DB::table('details_FCPCC')
            ->Where('dt_Fiche_ref', '=', $dt_Fiche)
            ->Where('etat', '=', $etat[0]->etat)
            ->groupBy(
                'id_Fiche',
                'date_controle',
                'AR_Ref',
                'AR_Design',
                'CT_Intitule',
                'position',
                'quantite',
                'FO_ref',
                'P_ref',
                'dosage',
                'fabricant',
                'T_Stockage_ref',
                'volume',
                'poids',
                'CT_Num',
                'FO_designation',
                'P_Intitule',
                'date_fab',
                'date_peremp',
                'Type_Stockage',
                'etat',
                'num_Lot',
                'dt_Fiche_ref',
                'ANS',
                'MOIS',
                'normes',
                'Libelle',
                'score',
                'Notation',
                'observation',
                'id_libelle',
                'ref_marche',
                'date_livraison',
                'fournisseur',
                'position'
            )
            ->select(
                'id_Fiche',
                'date_controle',
                'AR_Ref',
                'AR_Design',
                'CT_Intitule',
                'position',
                'quantite',
                'FO_ref',
                'P_ref',
                'dosage',
                'fabricant',
                'T_Stockage_ref',
                'volume',
                'poids',
                'CT_Num',
                'FO_designation',
                'P_Intitule',
                'date_fab',
                'date_peremp',
                'Type_Stockage',
                'etat',
                'num_Lot',
                'dt_Fiche_ref',
                'ANS',
                'MOIS',
                'normes',
                'Libelle',
                'score',
                'Notation',
                'observation',
                'id_libelle',
                'ref_marche',
                'date_livraison',
                'fournisseur',
                'position'
            )
            ->get();

        $pdf = PDF::setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
            'defaultFont' => 'sans-serif'
        ])->loadView('respStock.fiche_PDF', ['val' => $list]);
        return $pdf->download('fiche_n°' . $list[0]->id_Fiche . '.pdf');
    }

    public function calendar()
    {
        $events = array();
        $bookings = DB::table('fiche_details_fiche')
            ->groupBy('id_Fiche', 'AR_Ref', 'AR_Design', 'CT_Intitule', 'date_controle')
            ->select('id_Fiche', 'AR_Ref', 'AR_Design', 'CT_Intitule', DB::raw("sum(quantite) as total"), 'date_controle')
            ->get();
        foreach ($bookings as $booking) {
            $color = 'green';

            $events[] = [
                'id'   => $booking->id_Fiche,
                'title' => $booking->AR_Design,
                'start' => $booking->date_controle,
                'end' => $booking->date_controle,
                'color' => $color
            ];
        }
        return view('respStock.calendrier_reception', ['events' => $events]);
    }

    public function ficheInfo(Request $request)
    {
        $details_Fiche = DB::table('fiche_details_fiche')
            ->where('id_Fiche', '=', $request->id_Fiche)
            ->orderBy('num_Lot')
            ->select('fiche_details_fiche.*')
            ->get();
        $qteTotal = DB::table('fiche_details_fiche')
            ->where('id_Fiche', '=', $request->id_Fiche)
            ->groupBy('id_Fiche')
            ->select(DB::raw("sum(quantite) as total"))
            ->get();

        return view('respStock.details', ['details' => $details_Fiche, 'total' => $qteTotal]);
    }

    public function listeFicheAttente()
    {
        return view('respStock.listeFicheNonValide');
    }

    public function AjaxListeFicheAttente(Request $request)
    {
        $des = $request->filtre;
        $list = DB::table('fiche_details_fiche')
            ->Where('AR_Design', 'like', '%' . $des . '%')
            ->Where('etat', '=', -3)
            ->orWhere('etat', '=', -2)
            ->groupBy('id_Fiche', 'AR_Ref', 'AR_Design', 'CT_Intitule', 'date_controle', 'position', 'etat', 'dt_Fiche_ref')
            ->select("id_Fiche", "AR_Ref", "AR_Design", "CT_Intitule", DB::raw("sum(quantite) as total"), "date_controle", "Etat", "position", "dt_Fiche_ref");
        $val = $list->paginate(10);


        return view('respStock.ajaxliste-Fiches', ['val' => $val]);
    }

    public function detailsFiche($id_dt_Fiche)
    {
        $details_Fiche = DB::table('details_FCPCC')
            ->Where('dt_Fiche_ref', '=', $id_dt_Fiche)
            ->groupBy(
                'id_Fiche',
                'date_controle',
                'AR_Ref',
                'AR_Design',
                'CT_Intitule',
                'quantite',
                'FO_ref',
                'P_ref',
                'dosage',
                'fabricant',
                'T_Stockage_ref',
                'volume',
                'poids',
                'CT_Num',
                'FO_designation',
                'P_Intitule',
                'date_fab',
                'date_peremp',
                'Type_Stockage',
                'etat',
                'num_Lot',
                'dt_Fiche_ref',
                'ANS',
                'MOIS',
                'normes',
                'Libelle',
                'score',
                'Notation',
                'observation',
                'id_libelle',
                'ref_marche',
                'date_livraison',
                'fournisseur',
                'position'
            )
            ->select(
                'id_Fiche',
                'date_controle',
                'AR_Ref',
                'AR_Design',
                'CT_Intitule',
                'quantite',
                'FO_ref',
                'P_ref',
                'dosage',
                'fabricant',
                'T_Stockage_ref',
                'volume',
                'poids',
                'CT_Num',
                'FO_designation',
                'P_Intitule',
                'date_fab',
                'date_peremp',
                'Type_Stockage',
                'etat',
                'num_Lot',
                'dt_Fiche_ref',
                'ANS',
                'MOIS',
                'normes',
                'Libelle',
                'score',
                'Notation',
                'observation',
                'id_libelle',
                'ref_marche',
                'date_livraison',
                'fournisseur',
                'position',
            )
            ->get();
        $total_score = DB::table('dt_fiche_scores')
            ->Where('dt_Fiche_ref', '=', $id_dt_Fiche)
            ->select(
                DB::raw("sum(score) as total"),
                DB::raw("sum(score)*100/5 as pourc")
            )
            ->get();
        return view('respStock.details_Fiche', [
            'details' => $details_Fiche, 'total_score' => $total_score
        ]);
    }

    public function enregistrerFiche($dt_Fiche_ref)
    {
        DB::update("update details_Fiche set etat = 4 where dt_Fiche_ref = " . $dt_Fiche_ref);
        return redirect('/Stock/fiches-nouveau')->withSuccess('Fiche validée');
    }

}
