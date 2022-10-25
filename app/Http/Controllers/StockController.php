<?php

namespace App\Http\Controllers;

use App\Models\mvt_Stock;
use App\Models\Details_FCPCC;
use App\Models\Details_Fiche;
use App\Models\Details_Fiche_Score;
use App\Models\Fiche_Details_Fiche;
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
        $list = Fiche_Details_Fiche::getListeFicheValidee($des);
        return view('respStock.ajaxliste-Fiches', ['val' => $list]);
    }

    public function genererPDF($dt_Fiche)
    {
        $etat = Details_Fiche::getEtat($dt_Fiche);
        $list = Details_FCPCC::getDetailsFCPCC($dt_Fiche, $etat[0]->etat);

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
        $fiche = Fiche_Details_Fiche::getCalendarFiche();
        foreach ($fiche as $fiche) {
            $color = '#fc882d';

            $events[] = [
                'id'   => $fiche->id_Fiche,
                'title' => $fiche->AR_Design,
                'start' => $fiche->date_controle,
                'end' => $fiche->date_controle,
                'color' => $color
            ];
        }
        return view('respStock.calendrier_reception', ['events' => $events]);
    }

    public function ficheInfo(Request $request)
    {
        $id_Fiche = $request->id_Fiche;
        $details_Fiche = Fiche_Details_Fiche::getInfoDetailsFiche($id_Fiche);
        $qteTotal = Fiche_Details_Fiche::getQteTotal($id_Fiche);

        return view('respStock.details', ['details' => $details_Fiche, 'total' => $qteTotal]);
    }

    public function listeFicheAttente()
    {
        return view('respStock.listeFicheNonValide');
    }

    public function AjaxListeFicheAttente(Request $request)
    {
        $des = $request->filtre;
        $list = Fiche_Details_Fiche::getFicheEnAttente($des);

        return view('respStock.ajaxliste-Fiches', ['val' => $list]);
    }

    public function detailsFiche($id_dt_Fiche)
    {
        $details_Fiche = Details_FCPCC::getDetailsFCPCC($id_dt_Fiche, null);
        $total_score = Details_Fiche_Score::getPourcScore($id_dt_Fiche);
        return view('respStock.details_Fiche', [
            'details' => $details_Fiche, 'total_score' => $total_score
        ]);
    }

    public function enregistrerFiche($dt_Fiche_ref)
    {
        Details_Fiche::validerDtFiche($dt_Fiche_ref, 4);
        return redirect('/Stock/fiches-nouveau')->withSuccess('Fiche validée');
    }

    public function mvtStockStatPage()
    {
        return view('chefRayon.stat-Mvt-Stock');
    }

    public function mvtStockStat(Request $request)
    {
        $debut = $request->debut;
        $fin = $request->fin;
        $mois1 = $request->mois1;
        $mois2 = $request->mois2;

        $res = mvt_Stock::statMvtStock($debut, $fin, $mois1, $mois2);

        $labels = [];
        $dt = [];
        foreach ($res as $data) {
            if ($data->DATA > 0) {
                $labels[] = $data->MONTH;
                $dt[] = $data->DATA;
            }
        }

        return response()->json([
            'data' => $dt,
            'labels' => $labels
        ]);
    }
}
