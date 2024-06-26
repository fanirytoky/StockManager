<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Details_FCPCC extends Model
{
    use HasFactory;
    public $table = "details_FCPCC";

    public function getDetailsFCPCC($dt_Fiche, $etat)
    {
        if ($etat != null) {
            $list = DB::table('details_FCPCC')
                ->Where('dt_Fiche_ref', '=', $dt_Fiche)
                ->Where('etat', '=', $etat)
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
                    'position',
                    'ObsDecision'
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
                    'ObsDecision'
                )
                ->get();
        } else {
            $list = DB::table('details_FCPCC')
                ->Where('dt_Fiche_ref', '=', $dt_Fiche)
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
                    'position',
                    'ObsDecision'
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
                    'ObsDecision'
                )
                ->get();
        }

        return $list;
    }

    public function getStockDetails($dt_Fiche)
    {
        $details_Fiche = DB::table('details_FCPCC')
            ->Where('dt_Fiche_ref', '=', $dt_Fiche)
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
        return $details_Fiche;
    }

    public function getScoreQualiteParArtParFrns($filtre, $debut, $fin, $typeObject)
    {
        if ($typeObject == 2) {
            $val = DB::select("SELECT count(*) as data, * FROM 
            (
            select 
              case
                when (ANS*12)+MOIS <= 6 then 'Moins de 6 Mois'
                when (ANS*12)+MOIS > 6 AND (ANS*12)+MOIS <= 12 then '12 Mois'
                when (ANS*12)+MOIS > 12 AND (ANS*12)+MOIS <= 24 then '24 Mois'
                when (ANS*12)+MOIS > 24 then 'Plus de 24 Mois'
             END as labels 
             from fiche_details_Fiche
            ) t
            group by labels
            order by data ASC");
        } else {
            if ($typeObject == 0) {
                $typeObject = 'AR_Design';
            } else {
                $typeObject = 'CT_Intitule';
            }
            if ($debut != null && $fin != null) {
                $val = DB::table('details_FCPCC')
                    ->where($typeObject, 'like', '%' . $filtre . '%')
                    ->where('date_livraison', '>=', $debut)
                    ->where('date_livraison', '<=', $fin)
                    ->groupBy('CT_Intitule', 'AR_Design')
                    ->select(
                        DB::raw("CONCAT(SUBSTRING(AR_Design,1,20),'-'+SUBSTRING([CT_Intitule],1,15)) as labels"),
                        DB::raw("sum([score]) as total_score"),
                        DB::raw("(CEILING((sum([score])*100)/(SELECT sum(score) FROM [reception_salama].[dbo].[details_FCPCC] where AR_Design like '%" . $filtre . "%' and date_livraison >= '" . $debut . "' and date_livraison <= '" . $fin . "' ))) as pourc")
                    )
                    ->get();
            }
            if ($debut != null && $fin == null) {
                $val = DB::table('details_FCPCC')
                    ->where($typeObject, 'like', '%' . $filtre . '%')
                    ->where('date_livraison', '>=', $debut)
                    ->groupBy('CT_Intitule', 'AR_Design')
                    ->select(
                        DB::raw("CONCAT(SUBSTRING(AR_Design,1,20),'-'+SUBSTRING([CT_Intitule],1,15)) as labels"),
                        DB::raw("sum([score]) as total_score"),
                        DB::raw("(CEILING((sum([score])*100)/(SELECT sum(score) FROM [reception_salama].[dbo].[details_FCPCC] where AR_Design like '%" . $filtre . "%' and date_livraison >= '" . $debut . "'))) as pourc")
                    )
                    ->get();
            }
            if ($debut == null && $fin != null) {
                $val = DB::table('details_FCPCC')
                    ->where($typeObject, 'like', '%' . $filtre . '%')
                    ->where('date_livraison', '<=', $fin)
                    ->groupBy('CT_Intitule', 'AR_Design')
                    ->select(
                        DB::raw("CONCAT(SUBSTRING(AR_Design,1,20),'-'+SUBSTRING([CT_Intitule],1,15)) as labels"),
                        DB::raw("sum([score]) as total_score"),
                        DB::raw("(CEILING((sum([score])*100)/(SELECT sum(score) FROM [reception_salama].[dbo].[details_FCPCC] where AR_Design like '%" . $filtre . "%' and date_livraison <= '" . $fin . "' ))) as pourc")
                    )
                    ->get();
            }
            if ($debut == null && $fin == null) {
                $val = DB::table('details_FCPCC')
                    ->orWhere($typeObject, 'like', '%' . $filtre . '%')
                    ->groupBy('CT_Intitule', 'AR_Design','num_Lot','etat')
                    ->select(
                        'etat',
                        DB::raw("CONCAT(AR_Design,'-'+[CT_Intitule]) as labels"),
                        DB::raw("sum([score]) as total_score"),
                        DB::raw("(CEILING((sum([score])*100)/(SELECT sum(score) FROM [reception_salama].[dbo].[details_FCPCC] where AR_Design like '%" . $filtre . "%'))) as pourc")
                    )
                    ->get();
            }
        }

        return $val;
    }
}
