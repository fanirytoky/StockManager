<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Forme extends Model
{
    use HasFactory;
    public $table = "formes";
    public $timestamps = false;

    public function getFormeProposition($filtre)
    {
        $proposition = DB::table('formes')
            ->Where("FO_ref", "=", $filtre)
            ->select('formes.*')
            ->get();

        return $proposition;
    }

    public function getForme()
    {
        $forme = DB::table('formes')
            ->select('formes.*')
            ->get();
        return $forme;
    }
}
