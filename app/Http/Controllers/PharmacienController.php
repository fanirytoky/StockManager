<?php

namespace App\Http\Controllers;

use App\Models\Forme;
use App\Models\Type_Stockage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Details_Fiche_Score;

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
        $list = null;
        $list = DB::table('fiche_details_fiche')
            ->Where('AR_Design', 'like', '%' . $des . '%')
            ->Where('etat', '=', 2)
            ->groupBy('id_Fiche', 'dt_Fiche_ref', 'num_Lot', 'date_peremp',  'AR_Design', 'FO_designation', "P_Intitule", 'date_controle', 'Type_Stockage', 'position', 'etat')
            ->select("id_Fiche", 'dt_Fiche_ref', 'num_Lot', 'date_peremp', "AR_Design", "FO_designation", "P_Intitule", "date_controle", 'Type_Stockage', "Etat", "position");
        $val = $list->paginate(3);

        return view('Pharmacien.ajaxliste-Fiches', ['val' => $val]);
    }

    public function detailsFiche($id_dt_Fiche)
    {
        $details_Fiche = DB::table('fiche_details_fiche')
            ->where('dt_Fiche_ref', '=', $id_dt_Fiche)
            ->select('fiche_details_fiche.*')
            ->get();
        $condition = DB::table('controle_condition')
            ->join('Type_Condition', 'controle_condition.id_libelle', '=', 'Type_Condition.id')
            ->groupBy(
                'controle_condition.cond_controle_ref',
                'controle_condition.id_libelle',
                'controle_condition.normes',
                'Type_Condition.Libelle',
                'Type_Condition.Notation'
            )
            ->select(
                'controle_condition.cond_controle_ref',
                'controle_condition.id_libelle',
                'controle_condition.normes',
                'Type_Condition.Libelle',
                'Type_Condition.Notation'
            )
            ->distinct()
            ->get();
        $details_score = DB::table('dt_fiche_scores')
            ->Where('dt_Fiche_ref', '=', $id_dt_Fiche)
            ->select(
                'dt_fiche_scores.*'
            )
            ->get();
        $total_score = DB::table('dt_fiche_scores')
            ->Where('dt_Fiche_ref', '=', $id_dt_Fiche)
            ->select(
                DB::raw("sum(score) as total"),
                DB::raw("CASE WHEN " . DB::raw('sum(score)') . ">3 THEN 'Conditionnement Complet' ELSE 'Conditionnement non conforme' END AS etat_score")
            )
            ->get();
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
            DB::update("update details_Fiche set etat = 3 where dt_Fiche_ref = " . $dt_Fiche_ref);
            return redirect('/Pharmacien/fiches-nouveau')->withSuccess('Fiche validée');
        }
        //quarantaine
        elseif ($etat == 1) {
            DB::update("update details_Fiche set etat = -2 where dt_Fiche_ref = " . $dt_Fiche_ref);
            return redirect('/Pharmacien/fiches-nouveau')->withSuccess('Fiche mis en Quarantaine');
        }
        // Rebut
        elseif ($etat == 2) {
            DB::update("update details_Fiche set etat = -3 where dt_Fiche_ref = " . $dt_Fiche_ref);
            return redirect('/Pharmacien/fiches-nouveau')->withSuccess('Fiche mis en REBUT');
        }
    }

    public function editFiche($id_Fiche)
    {
        $forme = DB::table('formes')
            ->select('formes.*')
            ->get();
        $stockage = DB::table('Type_Stockage')
            ->select('Type_Stockage.*')
            ->get();
        $details = DB::table('fiche_details_fiche')
            ->orWhere('id_Fiche', '=', $id_Fiche)
            ->limit(1)
            ->select('fiche_details_fiche.*')
            ->get();
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
        DB::update("update details_Fiche set FO_ref = '" . $forme . "' , 
        dosage = " . $dosage . " , T_Stockage_ref = " . $t_stockage . " where id_Fiche = " . $idF);
        return view('Pharmacien.listeFicheAvalider');
    }

    public function AjaxListeFicheAttente(Request $request)
    {
        $des = $request->filtre;
        $list = null;
        $list = DB::table('fiche_details_fiche')
            ->Where('AR_Design', 'like', '%' . $des . '%')
            ->Where('etat', '=', -2)
            ->groupBy('id_Fiche', 'dt_Fiche_ref', 'num_Lot', 'date_peremp',  'AR_Design', 'FO_designation', "P_Intitule", 'date_controle', 'Type_Stockage', 'position', 'etat')
            ->select("id_Fiche", 'dt_Fiche_ref', 'num_Lot', 'date_peremp', "AR_Design", "FO_designation", "P_Intitule", "date_controle", 'Type_Stockage', "Etat", "position");
        $val = $list->paginate(3);

        return view('Pharmacien.ajaxliste-Fiches', ['val' => $val]);
    }

    public function AjaxListeFicheRebut(Request $request)
    {
        $des = $request->filtre;
        $list = null;
        $list = DB::table('fiche_details_fiche')
            ->Where('AR_Design', 'like', '%' . $des . '%')
            ->Where('etat', '=', -3)
            ->groupBy('id_Fiche', 'dt_Fiche_ref', 'num_Lot', 'date_peremp',  'AR_Design', 'FO_designation', "P_Intitule", 'date_controle', 'Type_Stockage', 'position', 'etat')
            ->select("id_Fiche", 'dt_Fiche_ref', 'num_Lot', 'date_peremp', "AR_Design", "FO_designation", "P_Intitule", "date_controle", 'Type_Stockage', "Etat", "position");
        $val = $list->paginate(3);

        return view('Pharmacien.ajaxliste-Fiches', ['val' => $val]);
    }
}
