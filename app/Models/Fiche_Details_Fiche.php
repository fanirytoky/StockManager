<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fiche_Details_Fiche extends Model
{
    use HasFactory;

    public function getListeDetailsFiche($des, $etat)
    {
        $list = DB::table('fiche_details_fiche')
            ->Where('AR_Design', 'like', '%' . $des . '%')
            ->Where('etat', '=', $etat)
            ->groupBy('id_Fiche', 'AR_Ref', 'AR_Design', 'CT_Intitule', 'date_controle', 'position', 'etat')
            ->select("id_Fiche", "AR_Ref", "AR_Design", "CT_Intitule", DB::raw("sum(quantite) as total"), "date_controle", "Etat", "position");
        $val = $list->paginate(10);
        return $val;
    }

    public function getDetailsFiche($id_Fiche)
    {
        $details = DB::table('fiche_details_fiche')
            ->orWhere('id_Fiche', '=', $id_Fiche)
            ->limit(1)
            ->select('fiche_details_fiche.*')
            ->get();
        return $details;
    }

    public function getInfoDetailsFiche($id_Fiche)
    {
        $details_Fiche = DB::table('fiche_details_fiche')
            ->where('id_Fiche', '=', $id_Fiche)
            ->orderBy('num_Lot')
            ->select('fiche_details_fiche.*')
            ->get();
        return $details_Fiche;
    }

    public function getQteTotal($id_Fiche)
    {
        $qteTotal = DB::table('fiche_details_fiche')
            ->where('id_Fiche', '=', $id_Fiche)
            ->groupBy('id_Fiche')
            ->select(DB::raw("sum(quantite) as total"))
            ->get();
        return $qteTotal;
    }

    public function getDtFicheAControler($des, $etat)
    {
        $list = DB::table('fiche_details_fiche')
            ->Where('AR_Design', 'like', '%' . $des . '%')
            ->Where('etat', '=', $etat)
            ->groupBy('id_Fiche', 'dt_Fiche_ref', 'num_Lot', 'date_peremp',  'AR_Design', 'FO_designation', "P_Intitule", 'date_controle', 'Type_Stockage', 'position', 'etat', 'Observation')
            ->select("id_Fiche", 'dt_Fiche_ref', 'num_Lot', 'date_peremp', "AR_Design", "FO_designation", "P_Intitule", "date_controle", 'Type_Stockage', "Etat", "position", 'Observation');
        $val = $list->paginate(3);
        return $val;
    }

    public function getDetailFicheById($id_dt_Fiche)
    {
        $details_Fiche = DB::table('fiche_details_fiche')
            ->where('dt_Fiche_ref', '=', $id_dt_Fiche)
            ->select('fiche_details_fiche.*')
            ->get();

        return $details_Fiche;
    }

    public function getListeFicheValidee($des)
    {
        $list = DB::table('fiche_details_fiche')
            ->where(static function ($query) {
                $query->where('etat', '=', 3)
                    ->orWhere('etat', '=', 4);
            })
            ->Where('AR_Design', 'like', '%' . $des . '%')
            ->groupBy('id_Fiche', 'AR_Ref', 'AR_Design', 'CT_Intitule', 'date_controle', 'position', 'etat', 'dt_Fiche_ref')
            ->select("id_Fiche", "AR_Ref", "AR_Design", "CT_Intitule", DB::raw("sum(quantite) as total"), "date_controle", "Etat", "position", "dt_Fiche_ref");
        $val = $list->paginate(5);
        return $val;
    }

    public function getCalendarFiche()
    {
        $fiche = DB::table('fiche_details_fiche')
            ->groupBy('id_Fiche', 'AR_Ref', 'AR_Design', 'CT_Intitule', 'date_controle')
            ->select('id_Fiche', 'AR_Ref', 'AR_Design', 'CT_Intitule', DB::raw("sum(quantite) as total"), 'date_controle')
            ->get();
        return $fiche;
    }

    public function getFicheEnAttente($des)
    {
        $list = DB::table('fiche_details_fiche')
            ->where(static function ($query) {
                $query->where('etat', '=', -3)
                    ->orWhere('etat', '=', -2);
            })
            ->Where('AR_Design', 'like', '%' . $des . '%')
            ->groupBy('id_Fiche', 'AR_Ref', 'AR_Design', 'CT_Intitule', 'date_controle', 'position', 'etat', 'dt_Fiche_ref')
            ->select("id_Fiche", "AR_Ref", "AR_Design", "CT_Intitule", DB::raw("sum(quantite) as total"), "date_controle", "Etat", "position", "dt_Fiche_ref");
        $val = $list->paginate(10);
        return $val;
    }

    public function getFicheAPlacer($des, $etat)
    {
        $list = DB::table('fiche_details_fiche')
            ->Where('etat', '=', $etat)
            ->Where('AR_Design', 'like', '%' . $des . '%')
            ->groupBy('id_Fiche', 'AR_Ref', 'AR_Design', 'num_Lot', 'P_Intitule', 'date_controle', "quantite", 'position', 'etat', 'dt_Fiche_ref')
            ->select("id_Fiche", "AR_Ref", "AR_Design", "num_Lot", 'P_Intitule', "quantite", "date_controle", "Etat", "position", "dt_Fiche_ref");
        $val = $list->paginate(10);
        return $val;
    }

    public function getDetailsTriArticle($data)
    {
        if ($data == 6) {
            $list = DB::table('fiche_details_fiche')
                ->where(DB::raw("(ANS*12)+MOIS"), '<=', 6)
                ->select('fiche_details_fiche.*');
            $val = $list->paginate(6);
        }
        if ($data == 12) {
            $list = DB::table('fiche_details_fiche')
                ->where(DB::raw("(ANS*12)+MOIS"), '>', 6)
                ->where(DB::raw(" (ANS*12)+MOIS"), '<=', 12)
                ->select('fiche_details_fiche.*');
            $val = $list->paginate(6);
        }
        if ($data == 24) {
            $list = DB::table('fiche_details_fiche')
                ->where(DB::raw("(ANS*12)+MOIS"), '>', 12)
                ->where(DB::raw(" (ANS*12)+MOIS"), '<=', 24)
                ->select('fiche_details_fiche.*');
            $val = $list->paginate(6);
        }
        if ($data == 48) {
            $list = DB::table('fiche_details_fiche')
                ->where(DB::raw("(ANS*12)+MOIS"), '>', 24)
                ->select('fiche_details_fiche.*');
            $val = $list->paginate(6);
        }
        return $val;
    }

    public function getListeFiches($des, $etat)
    {
        if ($etat == -1) {
            if ($des != null) {
                $list = DB::table('fiche_details_fiche')
                    ->Where('AR_Design', 'like', '%' . $des . '%')
                    ->orderBy('date_controle', 'ASC')
                    ->select('fiche_details_fiche.*');
                $val = $list->paginate(15);
            } else {
                $list = DB::table('fiche_details_fiche')
                    ->orderBy('date_controle', 'ASC')
                    ->select('fiche_details_fiche.*');
                $val = $list->paginate(15);
            }
        } else {
            if ($des != null) {
                $list = DB::table('fiche_details_fiche')
                    ->Where('AR_Design', 'like', '%' . $des . '%')
                    ->where('etat', '=', $etat)
                    ->orderBy('date_controle', 'ASC')
                    ->select('fiche_details_fiche.*');
                $val = $list->paginate(15);
            } else {
                $list = DB::table('fiche_details_fiche')
                    ->where('etat', '=', $etat)
                    ->orderBy('date_controle', 'ASC')
                    ->select('fiche_details_fiche.*');
                $val = $list->paginate(15);
            }
        }
        return $val;
    }
}
