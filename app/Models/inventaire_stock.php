<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
