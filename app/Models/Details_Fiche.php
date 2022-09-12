<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Details_Fiche extends Model
{
    use HasFactory;
    public $table="details_Fiche";
    public $timestamps=false;
    protected $fillable = ["id_Fiche","AR_Ref","FO_ref",
    "dosage","P_ref","P_quantite","fabricant","CT_Num",
    "quantite","T_Stockage_ref",
    "num_Lot","date_fab","date_peremp","volume","poids",
    "etat","id_User","Observation"];
}
