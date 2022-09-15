<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fournisseur extends Model
{
    use HasFactory;
    public $table = "F_COMPTET";
    public $timestamps = false;

    public function getFrns($filtre)
    {
        $fournisseur = DB::table('F_COMPTET')
            ->Where("CT_Num", "=", $filtre)
            ->select('F_COMPTET.*')
            ->get();

        return $fournisseur;
    }

    public function getListeFrns($filtre,$type)
    {
        $fournisseur = DB::table('F_COMPTET')
            ->Where('CT_Intitule', 'like', '%' . $filtre . '%')
            ->Where('CT_Type', '=', $type)
            ->select('F_COMPTET.*');
        $val = $fournisseur->paginate(10);
        return $val;
    }
}
