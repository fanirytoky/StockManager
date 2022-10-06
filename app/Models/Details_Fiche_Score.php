<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Details_Fiche_Score extends Model
{
    use HasFactory;
    public $table = "details_fiche_score";
    public $timestamps = false;
    protected $fillable = ["dt_fiche_ref", "condition_ref", "score", "observation", "id_user"];

    public function getDtScoreById($id_dt_Fiche)
    {
        $details_score = DB::table('dt_fiche_scores')
            ->Where('dt_Fiche_ref', '=', $id_dt_Fiche)
            ->select(
                'dt_fiche_scores.*'
            )
            ->get();

        return $details_score;
    }

    public function getTotalScore($id_dt_Fiche)
    {
        $total_score = DB::table('dt_fiche_scores')
            ->Where('dt_Fiche_ref', '=', $id_dt_Fiche)
            ->select(
                DB::raw("sum(score) as total"),
                DB::raw("CASE WHEN " . DB::raw('sum(score)') . ">3 THEN 'Contrôles et conditionnements complets' ELSE 'Contrôles et conditionnements non conformes' END AS etat_score")
            )
            ->get();

        return $total_score;
    }

    public function getPourcScore($id_dt_Fiche)
    {
        $total_score = DB::table('dt_fiche_scores')
            ->Where('dt_Fiche_ref', '=', $id_dt_Fiche)
            ->select(
                DB::raw("sum(score) as total"),
                DB::raw("sum(score)*100/5 as pourc")
            )
            ->get();
        return $total_score;
    }
}
