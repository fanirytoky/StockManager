<?php

namespace App\Http\Controllers;

use App\Models\Controle_Condition;
use App\Models\Details_FCPCC;
use App\Models\Details_Fiche;
use App\Models\Forme;
use App\Models\Type_Stockage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Details_Fiche_Score;
use App\Models\Fiche_Details_Fiche;

class PharmacienController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function listeNewFiche()
    {
        return view('Pharmacien.listeFicheAvalider');
    }

    public function listeFicheAttente()
    {
        return view('Pharmacien.listeFicheAttente');
    }
    public function listeFicheRebut()
    {
        return view('Pharmacien.listeFicheRebut');
    }

    public function AjaxListeFiche(Request $request)
    {
        $des = $request->filtre;
        $list = Fiche_Details_Fiche::getDtFicheAControler($des,2);
        return view('Pharmacien.ajaxliste-Fiches', ['val' => $list]);
    }

    public function detailsFiche($id_dt_Fiche)
    {
        $details_Fiche = Fiche_Details_Fiche::getDetailFicheById($id_dt_Fiche);
        $condition = Controle_Condition::getConditionnement();
        $details_score = Details_Fiche_Score::getDtScoreById($id_dt_Fiche);
        $total_score = Details_Fiche_Score::getTotalScore($id_dt_Fiche);
        return view('Pharmacien.detailsFiche', [
            'details' => $details_Fiche, 'conditionnements' => $condition, 'details_score' => $details_score, 'total_score' => $total_score
        ]);
    }

    public function storeScore(Request $request)
    {
        $score1 = $request->score1;
        $score2 = $request->score2;
        $observation1 = $request->observation1;
        $observation2 = $request->observation2;
        $cond_ref1 = $request->condition_ref1;
        $cond_ref2 = $request->condition_ref2;
        $dt_fiche_ref = $request->dt_fiche_ref;
        if ($score1 != null) {
            Details_Fiche_Score::create([
                'dt_fiche_ref' => $dt_fiche_ref,
                'condition_ref' => $cond_ref1,
                'score' => $score1,
                'observation' => $observation1,
                'id_user' => auth()->user()->id
            ]);
        }
        if ($score2 != null) {
            Details_Fiche_Score::create([
                'dt_fiche_ref' => $dt_fiche_ref,
                'condition_ref' => $cond_ref2,
                'score' => $score2,
                'observation' => $observation2,
                'id_user' => auth()->user()->id
            ]);
        }

        return redirect('/fiche-details-score/' . $dt_fiche_ref);
    }
    public function storeScores(Request $request)
    {
        $score = $request->score;
        $observation = $request->observation;
        $cond_ref = $request->condition_ref;
        $dt_fiche_ref = $request->dt_fiche_ref;
        Details_Fiche_Score::create([
            'dt_fiche_ref' => $dt_fiche_ref,
            'condition_ref' => $cond_ref,
            'score' => $score,
            'observation' => $observation,
            'id_user' => auth()->user()->id
        ]);
        return redirect('/fiche-details-score/' . $dt_fiche_ref);
    }

    public function decisionFiche($dt_Fiche_ref, $etat)
    {
        // acceptée
        if ($etat == 0) {
            Details_Fiche::validerDtFiche($dt_Fiche_ref,3);
            return redirect('/Pharmacien/fiches-nouveau')->withSuccess('Fiche validée');
        }
        //quarantaine
        elseif ($etat == 1) {
            Details_Fiche::validerDtFiche($dt_Fiche_ref,-2);
            return redirect('/Pharmacien/fiches-nouveau')->withSuccess('Fiche mis en Quarantaine');
        }
        // Rebut
        elseif ($etat == 2) {
            Details_Fiche::validerDtFiche($dt_Fiche_ref,-3);
            return redirect('/Pharmacien/fiches-nouveau')->withSuccess('Fiche mis en REBUT');
        }
    }

    public function editFiche($id_Fiche)
    {
        $forme = Forme::getForme();
        $stockage = Type_Stockage::getTypeStockage();
        $details = Fiche_Details_Fiche::getDetailsFiche($id_Fiche);
        return view('Pharmacien.fiche-modif', [
            'details' => $details,
            'forme' => $forme,
            'stockage' => $stockage
        ]);
    }

    public function updateFiche(Request $request)
    {
        $forme = $request->forme;
        $dosage = $request->dosage;
        $t_stockage = $request->t_stockage;
        $idF = $request->idF;
        Details_Fiche::updateFiche($forme,$dosage,$t_stockage,$idF);
        return redirect('/Pharmacien/fiches-nouveau')->withSuccess('Fiche modifiée');
    }

    public function AjaxListeFicheAttente(Request $request)
    {
        $des = $request->filtre;
        $list = Fiche_Details_Fiche::getDtFicheAControler($des,2);

        return view('Pharmacien.ajaxliste-Fiches', ['val' => $list]);
    }

    public function AjaxListeFicheRebut(Request $request)
    {
        $des = $request->filtre;
        $list = Fiche_Details_Fiche::getDtFicheAControler($des,-3);

        return view('Pharmacien.ajaxliste-Fiches', ['val' => $list]);
    }

    public function scoreQualiteFrnsPage()
    {
        return view('Pharmacien.chartEtat');
    }

    public function scoreQualiteFrns(Request $request)
    {
        $filtre = $request->filtre;
        $debut = $request->debut;
        $fin = $request->fin;
        $typeChart = $request->type;
        $unite = $request->unite;
        $typeObject = $request->typeObject;
        if($typeObject == null){
            $typeObject = 0;
        }
        $data = Details_FCPCC::getScoreQualiteParArtParFrns($filtre, $debut, $fin, $typeObject);
        $labels = [];
        $dt = [];
        foreach ($data as $data) {
            $labels[] = $data->labels;
            if($unite == 0){
                $dt[] = $data->total_score;
            }
            else{
                $dt[] = $data->pourc;
            }
        }

        return response()->json([
            'data' => $dt,
            'labels' => $labels,
            'type' => $typeChart
        ]);
    }
}
