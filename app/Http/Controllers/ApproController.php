<?php

namespace App\Http\Controllers;

use App\Models\User;
use \Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\mailNotification;
use App\Models\Fiche_reference;
use Illuminate\Support\Facades\DB;
use App\Mail\pharmacienNotification;
use App\Models\Fiche_Details_Fiche;
use App\Models\Fournisseur;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\Details_Fiche;


class ApproController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function listeNewFiche()
    {
        return view('respAppro.listeFicheAvalider');
    }

    public function AjaxListeFiche(Request $request)
    {
        session::forget('fournisseur');
        $des = $request->filtre;
        $etat = 1;
        $list = Fiche_Details_Fiche::getListeDetailsFiche($des, $etat);
        return view('respAppro.ajaxliste-Fiches', ['val' => $list]);
    }

    public function referenceFiche($id_Fiche)
    {
        $erreur = null;
        $details_Fiche = Fiche_Details_Fiche::getInfoDetailsFiche($id_Fiche);
        $qteTotal = Fiche_Details_Fiche::getQteTotal($id_Fiche);
        $frns = null;
        $CT_Num = Session::get('fournisseur');
        if ($CT_Num != null) {
            $frns = Fournisseur::getFrns($CT_Num);
            $fourni = Fiche_Details_Fiche::getDetailsFiche($id_Fiche);
            if ($fourni[0]->CT_Num != $CT_Num) {
                $erreur = 'Fournisseurs non identiques';
            }
        }

        return view('respAppro.referencierFiche', ['details' => $details_Fiche, 'total' => $qteTotal, 'frns' => $frns, 'erreur' => $erreur]);
    }

    public function ajaxListeFrns(Request $request)
    {
        session::forget('fournisseur');
        $filtre = $request->fournisseur;
        $id_fiche = $request->id_Fiche;
        $fournisseur = Fournisseur::getListeFrns($filtre,1);
        return view('respAppro.ajaxliste-Frns', ['val' => $fournisseur, 'id_Fiche' => $id_fiche]);
    }

    public function setSessionFrns($CT_Num, $id_Fiche)
    {
        Session::put('fournisseur', $CT_Num);
        return redirect('/fiche-referenciee/' . $id_Fiche,);
    }

    public function storeReference(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'ref' => ['required'],
                'CT_Num' => ['required'],
                'dt_livraison' => ['required'],
            ],
            [
                'ref.required' => 'Veuillez  remplir la reference du marché',
                'CT_Num.required' => 'Veuillez  remplir le fournisseur',
                'dt_livraison.required' => 'Veuillez  remplir la date de livraison',
            ]
        );

        if ($validator->fails()) {
            return  redirect()->back()->withErrors($validator)->withInput();
        }
        $id_Fiche = $request->id_Fiche;
        $CT_Num = $request->CT_Num;
        $ref = $request->ref;
        $dt_livraison = $request->dt_livraison;
        $email = $request->email;

        Fiche_reference::create([
            'ref_marche' => $ref,
            'date_livraison' => $dt_livraison,
            'fournisseur_ref' => $CT_Num,
            'id_Fiche' => $id_Fiche,
            'id_User' => auth()->user()->id
        ]);
        Details_Fiche::validerFiche($id_Fiche, 2);

        if ($email != null) {
            $details = [
                'id_Fiche' => $id_Fiche,
                'date' => $dt_livraison
            ];
            $users = User::where('post_id', 4)
                ->get();
            foreach ($users as $user) {
                Mail::to($user)->send(new pharmacienNotification($details));
            }
        }

        return redirect('/fiches-nouveau')->withSuccess('Nouvelle fiche referenciée');
    }


    public function tauxActiviteFrnsPage()
    {
        return view('respAppro.Acceuil');
    }

    public function tauxActiviteFrns(Request $request)
    {
        $debut = $request->debut;
        $fin = $request->fin;
        $typeChart = $request->type;
        $data = Fiche_reference::getTauxActivite($debut, $fin);
        $taux = [];
        $frns = [];
        $total = 0;
        foreach ($data as $data) {
            $taux[] = $data->taux;
            $frns[] = $data->CT_Intitule;
            $total = $data->total;
        }

        return response()->json([
            'taux' => $taux,
            'frns' => $frns,
            'total' => $total,
            'type' => $typeChart
        ]);
    }
}
