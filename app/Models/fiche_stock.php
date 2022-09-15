<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class fiche_stock extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fiche_stock';
    public $timestamps = false;
    protected $fillable = ["date", "dt_Fiche_ref", "DE_No"];

    public function getFicheStockById($dt_Fiche_ref)
    {
        $id_Fiche_Stock = DB::table('fiche_stock')
            ->where('dt_Fiche_ref', '=', $dt_Fiche_ref)
            ->select('fiche_stock.*')
            ->get();
        return $id_Fiche_Stock;
    }
}
