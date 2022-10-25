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
          WHERE date_mvt <= '" . $fin . "' and id_fiche_stock = " . $idFicheStock . "
        ) t 
        LEFT JOIN inventaire_stock i on i.date_inventaire<=date_mvt and i.date_inventaire>=date_mvt and i.id_fiche_stock = " . $idFicheStock . "
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
          WHERE id_fiche_stock = " . $idFicheStock . "
        ) t 
        LEFT JOIN inventaire_stock i on i.date_inventaire<=date_mvt and i.date_inventaire>=date_mvt and i.id_fiche_stock=" . $idFicheStock);
    return $mvt_stock;
  }

  public function getLastDateMvtStock($idFicheStock)
  {
    $mvt_stock = DB::select("SELECT max(date_mvt) as max
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
          WHERE id_fiche_stock = " . $idFicheStock . "
        ) t 
        LEFT JOIN inventaire_stock i on i.date_inventaire<=date_mvt and i.date_inventaire>=date_mvt and i.id_fiche_stock=" . $idFicheStock);
    return $mvt_stock;
  }

  public function statMvtStock($dateMax, $dateMin, $mois1, $mois2)
  {
      $val = DB::select("
        SELECT count(*) as DATA
      ,CASE WHEN MONTH(date_controle)=1 THEN 'Janvier'
      WHEN MONTH(date_controle)=2 THEN 'Fevrier'
      WHEN MONTH(date_controle)=3 THEN 'Mars'
      WHEN MONTH(date_controle)=4 THEN 'Avril'
      WHEN MONTH(date_controle)=5 THEN 'Mai'
      WHEN MONTH(date_controle)=6 THEN 'Juin'
      WHEN MONTH(date_controle)=7 THEN 'Juillet'
      WHEN MONTH(date_controle)=8 THEN 'Août'
      WHEN MONTH(date_controle)=9 THEN 'Septembre'
      WHEN MONTH(date_controle)=10 THEN 'Octobre'
      WHEN MONTH(date_controle)=11 THEN 'Novembre'
      WHEN MONTH(date_controle)=12 THEN 'Décembre' 
      END as MONTH
      FROM [reception_salama].[dbo].[fiche]
      WHERE MONTH(date_controle) BETWEEN ".$mois1." and ".$mois2."
      AND YEAR(date_controle) BETWEEN ".$dateMax." and ".$dateMin."
      GROUP BY MONTH(date_controle)");
    return $val;
  }

  public function ficheFiltre($filtre)
  {
    $val = DB::table('mvt_Stock')
      ->Where('AR_Design', 'like', '%' . $filtre . '%')
      ->groupBy("id_Fiche", "AR_Design", "AR_Ref")
      ->select(DB::raw("CONCAT(CONCAT('Fiche',id_Fiche),'-'+SUBSTRING(AR_Design,1,15)) as des"), "id_Fiche")
      ->get();
    return $val;
  }
}
