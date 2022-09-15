<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class mvt_Stock extends Model
{
    use HasFactory;
    public $table = "mvt_Stock";
    public $timestamps = false;

    public function getMvtStockEntreDeuxDates($debut, $fin, $idFicheStock)
    {
        $mvt_stock = DB::select(DB::raw("SELECT *
        FROM (
          SELECT date_mvt, 
                 id_fiche_stock,
                 num_Rack,
                 num_Doc,
                 CT_Num,
                 CT_Intitule,
                 entree,
                 sortie,
                 observation,
                 id_stock_empl,
                 SUM(entree-sortie) OVER(ORDER BY date_mvt,id_stock_empl asc) AS stock 
          FROM mvt_stock
          WHERE date_mvt <= '" . $fin . "' and id_fiche_stock = ".$idFicheStock."
        ) t 
        LEFT JOIN inventaire_stock i on i.date_inventaire<=date_mvt and i.date_inventaire>=date_mvt and i.id_fiche_stock = ".$idFicheStock."
        WHERE date_mvt >= '" . $debut . "'"));
        return $mvt_stock;
    }

    public function paginate($items, $perPage = 10, $page = null, $options = [])

    {

        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

        $items = $items instanceof Collection ? $items : Collection::make($items);

        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    public function getMvtStock($idFicheStock)
    {
        $mvt_stock = DB::select("SELECT *
        FROM (
          SELECT date_mvt, 
                 id_fiche_stock,
                 num_Rack,
                 num_Doc,
                 CT_Num,
                 CT_Intitule,
                 entree,
                 sortie,
                 observation,
                 id_stock_empl,
                 SUM(entree-sortie) OVER(ORDER BY date_mvt,id_stock_empl asc) AS stock
          FROM mvt_stock
          WHERE id_fiche_stock = ".$idFicheStock."
        ) t 
        LEFT JOIN inventaire_stock i on i.date_inventaire<=date_mvt and i.date_inventaire>=date_mvt and i.id_fiche_stock=".$idFicheStock);
        return $mvt_stock;
    }
}
