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
            ->groupBy('id_Fiche', 'dt_Fiche_ref', 'num_Lot', 'date_peremp',  'AR_Design', 'FO_designation', "P_Intitule", 'date_controle', 'Type_Stockage', 'position', 'etat')
            ->select("id_Fiche", 'dt_Fiche_ref', 'num_Lot', 'date_peremp', "AR_Design", "FO_designation", "P_Intitule", "date_controle", 'Type_Stockage', "Etat", "position");
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
            ->Where('AR_Design', 'like', '%' . $des . '%')
            ->Where('etat', '=', 3)
            ->orWhere('etat', '=', 4)
            ->orWhere('etat', '=', 5)
            ->groupBy('id_Fiche', 'AR_Ref', 'AR_Design', 'CT_Intitule', 'date_controle', 'position', 'etat', 'dt_Fiche_ref')
            ->select("id_Fiche", "AR_Ref", "AR_Design", "CT_Intitule", DB::raw("sum(quantite) as total"), "date_controle", "Etat", "position", "dt_Fiche_ref");
        $val = $list->paginate(10);
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
            ->Where('AR_Design', 'like', '%' . $des . '%')
            ->Where('etat', '=', -3)
            ->orWhere('etat', '=', -2)
            ->groupBy('id_Fiche', 'AR_Ref', 'AR_Design', 'CT_Intitule', 'date_controle', 'position', 'etat', 'dt_Fiche_ref')
            ->select("id_Fiche", "AR_Ref", "AR_Design", "CT_Intitule", DB::raw("sum(quantite) as total"), "date_controle", "Etat", "position", "dt_Fiche_ref");
        $val = $list->paginate(10);
        return $val;
    }

    public function getFicheAPlacer($des,$etat){
        $list = DB::table('fiche_details_fiche')
            ->Where('etat', '=', $etat)
            ->Where('AR_Design', 'like', '%' . $des . '%')
            ->groupBy('id_Fiche', 'AR_Ref', 'AR_Design', 'num_Lot', 'P_Intitule', 'date_controle', "quantite", 'position', 'etat', 'dt_Fiche_ref')
            ->select("id_Fiche", "AR_Ref", "AR_Design", "num_Lot", 'P_Intitule', "quantite", "date_controle", "Etat", "position", "dt_Fiche_ref");
        $val = $list->paginate(10);
        return $val;
    }
}
