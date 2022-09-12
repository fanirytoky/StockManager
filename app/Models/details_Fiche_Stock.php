<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class details_Fiche_Stock extends Model
{
    use HasFactory;
    public $table = "details_Fiche_Stock";
    public $timestamps = false;
    protected $fillable = [
        "id_stock_empl", "CT_Num", "num_Doc", "entree", "sortie", "observation", "date", "id_user"
    ];
}
