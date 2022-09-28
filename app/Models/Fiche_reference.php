<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fiche_reference extends Model
{
    use HasFactory;
    protected $table = 'fiche_reference';
    public $timestamps = false;
    protected $fillable = ["ref_marche", "date_livraison", "fournisseur_ref", "id_Fiche", "id_User"];

    public function getTauxActivite($filtre, $debut, $fin)
    {
        if ($filtre == null) {
            if ($debut == null && $fin == null) {
                $data = DB::table('fiche_reference')
                    ->select(
                        DB::raw('((count(date_livraison)*100)/(select count(ref_marche) from fiche_reference)) as taux'),
                        'fournisseur_ref',
                        'CT_Intitule',
                        DB::raw('(select count(ref_marche) from fiche_reference) as total')
                    )
                    ->leftJoin('F_COMPTET', 'F_COMPTET.CT_Num', '=', 'fiche_reference.fournisseur_ref')
                    ->groupBy('fournisseur_ref', 'CT_Intitule')
                    ->get();
            }
            if ($debut != null && $fin == null) {
                $data = DB::table('fiche_reference')
                    ->select(
                        DB::raw("((count(date_livraison)*100)/(select count(ref_marche) from fiche_reference 
                    where date_livraison >= '" . $debut . "')) as taux"),
                        'fournisseur_ref',
                        'CT_Intitule',
                        DB::raw("(select count(ref_marche) from fiche_reference where date_livraison >= '" . $debut . "') as total")
                    )
                    ->leftJoin('F_COMPTET', 'F_COMPTET.CT_Num', '=', 'fiche_reference.fournisseur_ref')
                    ->where('date_livraison', '>=', $debut)
                    ->groupBy('fournisseur_ref', 'CT_Intitule')
                    ->get();
            }
            if ($fin != null && $debut == null) {
                $data = DB::table('fiche_reference')
                    ->select(
                        DB::raw("((count(date_livraison)*100)/(select count(ref_marche) from fiche_reference 
                    where date_livraison <= '" . $fin . "')) as taux"),
                        'fournisseur_ref',
                        'CT_Intitule',
                        DB::raw("(select count(ref_marche) from fiche_reference where date_livraison <= '" . $fin . "') as total")
                    )
                    ->leftJoin('F_COMPTET', 'F_COMPTET.CT_Num', '=', 'fiche_reference.fournisseur_ref')
                    ->where('date_livraison', '<=', $fin)
                    ->groupBy('fournisseur_ref', 'CT_Intitule')
                    ->get();
            }
            if ($fin != null && $debut != null) {
                $data = DB::table('fiche_reference')
                    ->select(
                        DB::raw("((count(date_livraison)*100)/(select count(ref_marche) from fiche_reference 
                where date_livraison >= '" . $debut . "' and date_livraison <= '" . $fin . "')) as taux"),
                        'fournisseur_ref',
                        'CT_Intitule',
                        DB::raw("(select count(ref_marche) from fiche_reference where date_livraison >= '" . $debut . "' and date_livraison <= '" . $fin . "') as total")
                    )
                    ->leftJoin('F_COMPTET', 'F_COMPTET.CT_Num', '=', 'fiche_reference.fournisseur_ref')
                    ->where('date_livraison', '>=', $debut)
                    ->where('date_livraison', '<=', $fin)
                    ->groupBy('fournisseur_ref', 'CT_Intitule')
                    ->get();
            }
        } else {
            if ($debut == null && $fin == null) {
                $data = DB::table('fiche_reference')
                    ->where('CT_Intitule', 'like', '%' . $filtre . '%')
                    ->select(
                        DB::raw('((count(date_livraison)*100)/(select count(ref_marche) from fiche_reference)) as taux'),
                        'fournisseur_ref',
                        'CT_Intitule',
                        DB::raw('(select count(ref_marche) from fiche_reference) as total')
                    )
                    ->leftJoin('F_COMPTET', 'F_COMPTET.CT_Num', '=', 'fiche_reference.fournisseur_ref')
                    ->groupBy('fournisseur_ref', 'CT_Intitule')
                    ->get();
            }
            if ($debut != null && $fin == null) {
                $data = DB::table('fiche_reference')
                    ->where('CT_Intitule', 'like', '%' . $filtre . '%')
                    ->select(
                        DB::raw("((count(date_livraison)*100)/(select count(ref_marche) from fiche_reference 
                    where date_livraison >= '" . $debut . "')) as taux"),
                        'fournisseur_ref',
                        'CT_Intitule',
                        DB::raw("(select count(ref_marche) from fiche_reference where date_livraison >= '" . $debut . "') as total")
                    )
                    ->leftJoin('F_COMPTET', 'F_COMPTET.CT_Num', '=', 'fiche_reference.fournisseur_ref')
                    ->where('date_livraison', '>=', $debut)
                    ->groupBy('fournisseur_ref', 'CT_Intitule')
                    ->get();
            }
            if ($fin != null && $debut == null) {
                $data = DB::table('fiche_reference')
                    ->where('CT_Intitule', 'like', '%' . $filtre . '%')
                    ->select(
                        DB::raw("((count(date_livraison)*100)/(select count(ref_marche) from fiche_reference 
                    where date_livraison <= '" . $fin . "')) as taux"),
                        'fournisseur_ref',
                        'CT_Intitule',
                        DB::raw("(select count(ref_marche) from fiche_reference where date_livraison <= '" . $fin . "') as total")
                    )
                    ->leftJoin('F_COMPTET', 'F_COMPTET.CT_Num', '=', 'fiche_reference.fournisseur_ref')
                    ->where('date_livraison', '<=', $fin)
                    ->groupBy('fournisseur_ref', 'CT_Intitule')
                    ->get();
            }
            if ($fin != null && $debut != null) {
                $data = DB::table('fiche_reference')
                    ->where('CT_Intitule', 'like', '%' . $filtre . '%')
                    ->select(
                        DB::raw("((count(date_livraison)*100)/(select count(ref_marche) from fiche_reference 
                where date_livraison >= '" . $debut . "' and date_livraison <= '" . $fin . "')) as taux"),
                        'fournisseur_ref',
                        'CT_Intitule',
                        DB::raw("(select count(ref_marche) from fiche_reference where date_livraison >= '" . $debut . "' and date_livraison <= '" . $fin . "') as total")
                    )
                    ->leftJoin('F_COMPTET', 'F_COMPTET.CT_Num', '=', 'fiche_reference.fournisseur_ref')
                    ->where('date_livraison', '>=', $debut)
                    ->where('date_livraison', '<=', $fin)
                    ->groupBy('fournisseur_ref', 'CT_Intitule')
                    ->get();
            }
        }

        return $data;
    }
}
