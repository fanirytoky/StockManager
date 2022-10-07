<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class inventaire_stock extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'inventaire_stock';
    public $timestamps=false;
    protected $fillable = ["id_fiche_stock","quantite","date_inventaire","observations"];

    public function updateEtatInventaire($id_inventaire,$etat){
        DB::update("update inventaire_stock set etat = " . $etat . " where id_inventaire = " . $id_inventaire);
    }
}
