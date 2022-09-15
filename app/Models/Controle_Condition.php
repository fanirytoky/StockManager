<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Controle_Condition extends Model
{
    use HasFactory;
    public $table = "controle_condition";

    public function getConditionnement()
    {
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
        return $condition;
    }
}
