<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Type_Stockage extends Model
{
    use HasFactory;
    public $table = "Type_Stockage";
    public $timestamps = false;

    public function getTypeStockage()
    {
        $type = DB::table('Type_Stockage')
            ->select('Type_Stockage.*')
            ->get();
        return $type;
    }
}
