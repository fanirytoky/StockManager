<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fiche_reference extends Model
{
    use HasFactory;
    protected $table = 'fiche_reference';
    public $timestamps=false;
    protected $fillable = ["ref_marche","date_livraison","fournisseur_ref","id_Fiche","id_User"];

}
