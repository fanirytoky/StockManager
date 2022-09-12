<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fiche_stock extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fiche_stock';
    public $timestamps=false;
    protected $fillable = ["date","dt_Fiche_ref","DE_No"];
}
