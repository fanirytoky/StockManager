<?php

namespace App\Http\Controllers;

use App\Models\User;
use \Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\mailNotification;
use App\Models\Fiche_reference;
use Illuminate\Support\Facades\DB;
use App\Mail\pharmacienNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


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
        $list = null;
        $list = DB::table('fiche_details_fiche')
            ->Where('AR_Design', 'like', '%' . $des . '%')
            ->Where('etat', '=', 1)
            ->groupBy('id_Fiche', 'AR_Ref', 'AR_Design', 'CT_Intitule', 'date_controle', 'position', 'etat')
            ->select("id_Fiche", "AR_Ref", "AR_Design", "CT_Intitule", DB::raw("sum(quantite) as total"), "date_controle", "Etat", "position");
        $val = $list->paginate(10);

        return view('respAppro.ajaxliste-Fiches', ['val' => $val]);
    }

    public function referenceFiche($id_Fiche)
    {
        $erreur = null;
        $details_Fiche = DB::table('fiche_details_fiche')
            ->where('id_Fiche', '=', $id_Fiche)
            ->orderBy('num_Lot')
            ->select('fiche_details_fiche.*')
            ->get();
        $qteTotal = DB::table('fiche_details_fiche')
            ->where('id_Fiche', '=', $id_Fiche)
            ->groupBy('id_Fiche')
            ->select(DB::raw("sum(quantite) as total"))
            ->get();
        $frns = null;
        $CT_Num = Session::get('fournisseur');
        if ($CT_Num != null) {
            $frns = DB::table('F_COMPTET')
                ->Where("CT_Num", "=", $CT_Num)
                ->select('F_COMPTET.*')
                ->get();

            $fourni = DB::table('fiche_details_fiche')
                ->where('id_Fiche', '=', $id_Fiche)
                ->select('CT_Num')
                ->distinct()
                ->get();

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
        $fournisseur = DB::table('F_COMPTET')
            ->orWhere('CT_Intitule', 'like', '%' . $filtre . '%')
            ->select('F_COMPTET.*');
        $val = $fournisseur->paginate(10);
        return view('respAppro.ajaxliste-Frns', ['val' => $val, 'id_Fiche' => $id_fiche]);
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

        DB::update("update details_Fiche set etat = 2 where id_Fiche = " . $id_Fiche);

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


    public function tauxActiviteFrnsPage(){
        return view('respAppro.Acceuil');
    }

    public function tauxActiviteFrns(Request $request)
    {
        $debut = $request->debut;
        $fin = $request->fin;
        $typeChart = $request->type;


        if ($debut == null && $fin == null) {
            $data = DB::table('fiche_reference')
                ->select(
                    DB::raw('((count(date_livraison)*100)/(select count(ref_marche) from fiche_reference)) as taux'),
                    'fournisseur_ref',
                    'CT_Intitule',
                    DB::raw('(select count(ref_marche) from fiche_reference) as total')
                )
                ->leftJoin('F_COMPTET', 'F_COMPTET.CT_Num', '=', 'fiche_reference.fournisseur_ref')
                ->groupBy('fournisseur_ref', 'CT_Intitule')
                ->get();
        }
        if ($debut != null && $fin == null) {
            $data = DB::table('fiche_reference')
                ->select(
                    DB::raw("((count(date_livraison)*100)/(select count(ref_marche) from fiche_reference 
                    where date_livraison >= '" . $debut . "')) as taux"),
                    'fournisseur_ref',
                    'CT_Intitule',
                    DB::raw("(select count(ref_marche) from fiche_reference where date_livraison >= '" . $debut . "') as total")
                )
                ->leftJoin('F_COMPTET', 'F_COMPTET.CT_Num', '=', 'fiche_reference.fournisseur_ref')
                ->where('date_livraison', '>=', $debut)
                ->groupBy('fournisseur_ref', 'CT_Intitule')
                ->get();
        }
        if ($fin != null && $debut == null) {
            $data = DB::table('fiche_reference')
                ->select(
                    DB::raw("((count(date_livraison)*100)/(select count(ref_marche) from fiche_reference 
                    where date_livraison <= '" . $fin . "')) as taux"),
                    'fournisseur_ref',
                    'CT_Intitule',
                    DB::raw("(select count(ref_marche) from fiche_reference where date_livraison <= '" . $fin . "') as total")
                )
                ->leftJoin('F_COMPTET', 'F_COMPTET.CT_Num', '=', 'fiche_reference.fournisseur_ref')
                ->where('date_livraison', '<=', $fin)
                ->groupBy('fournisseur_ref', 'CT_Intitule')
                ->get();
        }
        if ($fin != null && $debut != null) {
            $data = DB::table('fiche_reference')
                ->select(
                    DB::raw("((count(date_livraison)*100)/(select count(ref_marche) from fiche_reference 
                where date_livraison >= '" . $debut . "' and date_livraison <= '" . $fin . "')) as taux"),
                    'fournisseur_ref',
                    'CT_Intitule',
                    DB::raw("(select count(ref_marche) from fiche_reference where date_livraison >= '" . $debut . "' and date_livraison <= '" . $fin . "') as total")
                )
                ->leftJoin('F_COMPTET', 'F_COMPTET.CT_Num', '=', 'fiche_reference.fournisseur_ref')
                ->where('date_livraison', '>=', $debut)
                ->where('date_livraison', '<=', $fin)
                ->groupBy('fournisseur_ref', 'CT_Intitule')
                ->get();
        }

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

        // return view('respAppro.Acceuil', ['taux' => $taux, 'frns' => $frns, 'typeChart' => $typeChart]);
    }
}
