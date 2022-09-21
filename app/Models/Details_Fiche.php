<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Details_Fiche extends Model
{
    use HasFactory;
    public $table = "details_Fiche";
    public $timestamps = false;
    protected $fillable = [
        "id_Fiche", "AR_Ref", "FO_ref",
        "dosage", "P_ref", "P_quantite", "fabricant", "CT_Num",
        "quantite", "T_Stockage_ref",
        "num_Lot", "date_fab", "date_peremp", "volume", "poids",
        "etat", "id_User", "Observation"
    ];

    public function validerFiche($id_Fiche, $etat)
    {
        DB::update("update details_Fiche set etat = " . $etat . " where id_Fiche = " . $id_Fiche);
    }

    public function validerDtFiche($dt_Fiche_ref, $etat)
    {
        DB::update("update details_Fiche set etat = " . $etat . " where dt_Fiche_ref = " . $dt_Fiche_ref);
    }

    public function updateFiche($forme, $dosage, $t_stockage, $idF)
    {
        DB::update("update details_Fiche set FO_ref = '" . $forme . "' , 
        dosage = '" . $dosage . "' , T_Stockage_ref = " . $t_stockage . " where id_Fiche = " . $idF);
    }
    public function DecisionFicheRemarque($observation,$dt_Fiche_ref)
    {
        DB::update("update details_Fiche set Observation = '" . $observation . "' where dt_Fiche_ref = " . $dt_Fiche_ref);
    }

    public function getEtat($dt_Fiche)
    {
        $etat = DB::table('details_Fiche')
            ->Where('dt_Fiche_ref', '=', $dt_Fiche)
            ->select('details_Fiche.etat')
            ->get();
        return $etat;
    }
}
