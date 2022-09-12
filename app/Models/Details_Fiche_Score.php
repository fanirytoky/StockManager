<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Details_Fiche_Score extends Model
{
    use HasFactory;
    public $table="details_fiche_score";
    public $timestamps=false;
    protected $fillable = ["dt_fiche_ref","condition_ref","score","observation","id_user"];
}
