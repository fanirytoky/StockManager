<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fiche_Details_Fiche;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        return view('Acceuil');
    }

    public function listeFichesPage()
    {
        return view('listeFiches');
    }

    public function listeFiches(Request $request){
        $des = $request->filtre;
        $etat = $request->etat;
        $list = Fiche_Details_Fiche::getListeFiches($des,$etat);
        return view('ajaxlisteFiche', ['val' => $list]);
    }
}
