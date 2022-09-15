<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class dt_Fiche_Stock_Empl extends Model
{
    use HasFactory;
    public $table = "dt_fiche_stock";
    public $timestamps = false;

    public function getTotalEnPlace($id_dt_Fiche)
    {
        $dt_fiche_empl = DB::table('dt_fiche_stock')
            ->where('dt_Fiche_ref', '=', $id_dt_Fiche)
            ->select(DB::raw('sum(qte_sur_rack) as totalEnPlace'))
            ->get();

        return $dt_fiche_empl;
    }

    public function getFicheStock($des)
    {
        $list = DB::table('dt_fiche_stock')
            ->orWhere('AR_Design', 'like', '%' . $des . '%')
            ->orWhere('AR_Ref', 'like', '%' . $des . '%')
            ->orWhere('num_Lot', 'like', '%' . $des . '%')
            ->groupBy(
                'id_fiche_stock',
                'AR_Ref',
                'AR_Design',
                'quantite',
                'P_Intitule',
                'date_peremp',
                'num_Lot',
                'dt_Fiche_ref',
                'DE_Intitule'
            )
            ->select(
                'id_fiche_stock',
                'AR_Ref',
                'AR_Design',
                'quantite',
                'P_Intitule',
                'date_peremp',
                'num_Lot',
                'dt_Fiche_ref',
                DB::raw('sum(qte_sur_rack) as total'),
                'DE_Intitule'
            );
        $val = $list->paginate(10);

        return $val;
    }

    public function getDtFichStockById($id_fiche_stock)
    {
        $details = DB::table('dt_fiche_stock')
            ->where('id_fiche_stock', "=", $id_fiche_stock)
            ->select('dt_fiche_stock.*')
            ->get();
        return $details;
    }

    public function getStockEmplacement($des, $id_fiche_stock)
    {
        $stock_empl = DB::table('dt_fiche_stock')
            ->Where('num_Rack', 'like', '%' . $des . '%')
            ->Where('id_fiche_stock', 'like', '%' . $id_fiche_stock . '%')
            ->select('dt_fiche_stock.*', DB::raw('(SELECT (sum([entree]))-(sum([sortie]))
  FROM [reception_salama].[dbo].[details_Fiche_Stock] q  where [id_stock_empl] = dt_fiche_stock.id_stock_Empl GROUP BY [id_stock_empl]) as Reste'));
        $val = $stock_empl->paginate(10);
        return $val;
    }
}
