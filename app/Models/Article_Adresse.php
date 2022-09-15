<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article_Adresse extends Model
{
    use HasFactory;

    public function getListArtAdresse($des)
    {
        $adresse = DB::table('articles_Adresses')
            ->orWhere('DP_Code', 'like', '%' . $des . '%')
            ->orWhere('DP_Intitule', 'like', '%' . $des . '%')
            ->orWhere('AR_Ref', 'like', '%' . $des . '%')
            ->select('articles_Adresses.*');
        $val = $adresse->paginate(15);
        return $val;
    }

    public function getAdresseByRef($ref)
    {
        $adr = DB::table('articles_Adresses')
            ->where('AR_Ref', '=', $ref)
            ->select('articles_Adresses.*')
            ->get();
        return $adr;
    }
}
