<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stock_Empl extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'stock_Empl';
    public $timestamps=false;
    protected $fillable = ["id_fiche_stock","num_Rack","quantite","Date","observation"];
}
