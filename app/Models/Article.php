<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;
    public $table = "F_ARTICLE";
    public $timestamps = false;


    public function getDesignation($AR_Ref)
    {
        $designation = DB::table('F_ARTICLE')
            ->Where("AR_Ref", "=", $AR_Ref)
            ->select('F_ARTICLE.*')
            ->get();

        return $designation;
    }

    public function getListArticles($des){
        $article = DB::table('F_ARTICLE')
            ->join('F_FAMILLE', 'F_ARTICLE.FA_CodeFamille', '=', 'F_FAMILLE.FA_CodeFamille')
            ->orWhere('AR_Design', 'like', '%' . $des . '%')
            ->orWhere('AR_Ref', 'like', '%' . $des . '%')
            ->groupBy('F_ARTICLE.AR_Ref', 'F_ARTICLE.FA_CodeFamille', 'F_ARTICLE.AR_Design', 'F_ARTICLE.cbMarq', 'F_FAMILLE.FA_Intitule')
            ->select('F_ARTICLE.*', 'F_FAMILLE.FA_Intitule');
        $val = $article->paginate(10);
        return $val;
    }
}
