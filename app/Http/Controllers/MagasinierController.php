<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\fiche;
use App\Models\Forme;
use App\Models\Presentation;
use Illuminate\Http\Request;
use App\Models\Details_Fiche;
use App\Models\Type_Stockage;
use App\Mail\mailNotification;
use App\Models\Article;
use App\Models\Article_Adresse;
use App\Models\Fiche_Details_Fiche;
use App\Models\Fournisseur;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class MagasinierController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function createFiche()
    {
        $designation = null;
        $fournisseur = null;
        $proposition = null;
        $AR_Ref = Session::get('designation');
        $CT_Num = Session::get('fournisseur');
        if ($AR_Ref != null) {
            $designation = Article::getDesignation($AR_Ref);

            $split = str_split($AR_Ref);
            $proposition = Forme::getFormeProposition($split[10]);
        }
        if ($CT_Num != null) {
            $fournisseur = Fournisseur::getFrns($CT_Num);
        }
        $forme = Forme::all();
        $presentation = Presentation::all();
        $stockage = Type_Stockage::all();
        return view('Magasinier.create-fiche', [
            'designation' => $designation, 'forme' => $forme,
            'presentation' => $presentation, 'fournisseur' => $fournisseur,
            'stockage' => $stockage, 'proposition' => $proposition
        ]);
    }

    public function fiches()
    {
        return view('Magasinier.listeFiches');
    }

    public function ajaxListeArticle(Request $request)
    {
        $des = $request->designation;
        $articles = Article::getListArticles($des);
        return view('Magasinier.ajaxliste-Articles', ['val' => $articles]);
    }

    public function setSession($AR_Ref)
    {
        $value = $AR_Ref;
        Session::put('designation', $value);
        return redirect('/fiche-create');
    }

    public function ajaxListeFrns(Request $request)
    {
        $filtre = $request->fournisseur;
        $fournisseurs = Fournisseur::getListeFrns($filtre, 1);
        return view('Magasinier.ajaxliste-Frns', ['val' => $fournisseurs]);
    }

    public function setSessionFrns($CT_Num)
    {
        $value = $CT_Num;
        Session::put('fournisseur', $value);
        return redirect('/fiche-create');
    }

    public function storeFiche(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'AR_Ref' => ['required'],
                'CT_Num' => ['required'],
                'lot' => ['required'],
                'quantite' => ['required'],
                'date_peremp' => ['required'],
            ],
            [
                'AR_Ref.required' => 'Veuillez  remplir la designation',
                'CT_Num.required' => 'Veuillez  remplir le fournisseur',
                'lot.required' => 'Veuillez  remplir le lot',
                'quantite.required' => 'Veuillez  remplir la quantite',
                'date_peremp.required' => 'Veuillez  remplir la date de peremption',
            ]
        );

        if ($validator->fails()) {
            return  redirect()->back()->withErrors($validator)->withInput();
        }

        $id_Fiche = $request->idF;
        $art_ref = $request->AR_Ref;
        $forme = $request->forme;
        $dosage = $request->dosage;
        $presentation = $request->presentation;
        $lot = $request->lot;
        $date_fab = $request->date_fab;
        $fabricant = $request->fabricant;
        $fournisseur = $request->CT_Num;
        $quantite = $request->quantite;
        $stockage = $request->t_stockage;
        $date_peremp = $request->date_peremp;
        $volume = $request->volume;
        $poids = $request->poids;
        $observation = $request->observation;
        $P_quantite = $request->P_quantite;
        $email = $request->email;
        $fiche_id = null;

        if ($id_Fiche == null) {
            $idF = Fiche::create([
                'date_controle' => now(),
            ]);
            $fiche_id = $idF->id;
        } else {
            $fiche_id = $id_Fiche;
        }

        Details_Fiche::create([
            'id_Fiche' => $fiche_id,
            'AR_Ref' => $art_ref,
            'FO_ref' => $forme,
            'dosage' => $dosage,
            'P_ref' => $presentation,
            'P_quantite' => $P_quantite,
            'fabricant' => $fabricant,
            'quantite' => $quantite,
            'T_Stockage_ref' => $stockage,
            'num_Lot' => $lot,
            'date_fab' => $date_fab,
            'date_peremp' => $date_peremp,
            'volume' => $volume,
            'poids' => $poids,
            'id_User' => auth()->user()->id,
            'CT_Num' => $fournisseur,
            'etat' => 0,
            'Observation' => $observation
        ]);
        if ($id_Fiche == null) {
            if ($email != null) {
                $details = [
                    'id_Fiche' => $id_Fiche,
                    'AR_Design' =>  $request->design,
                    'date' => now(),
                    'nom' => auth()->user()->name
                ];
                $users = User::where('post_id', 3)
                    ->get();
                foreach ($users as $user) {
                    Mail::to($user)->send(new mailNotification($details));
                }
            }
            return redirect()->back()->withSuccess('Nouvelle fiche enregistrée');
        }

        Session::forget('designation');
        Session::forget('fournisseur');

        return redirect('/fiches')->withSuccess('Lot enregistré');
    }

    public function AjaxListeFiche(Request $request)
    {
        $des = $request->filtre;
        $etat = 0;
        $list = Fiche_Details_Fiche::getListeDetailsFiche($des, $etat);
        return view('Magasinier.ajaxliste-Fiches', ['val' => $list]);
    }

    public function ajoutLot($id_Fiche)
    {
        $details = Fiche_Details_Fiche::getDetailsFiche($id_Fiche);
        $forme = Forme::all();
        $stockage = Type_Stockage::all();
        return view('Magasinier.ajoutLot', [
            'details' => $details,
            'forme' => $forme,
            'stockage' => $stockage
        ]);
    }

    public function validerFiche($id_Fiche)
    {
        Details_Fiche::validerFiche($id_Fiche, 1);
        return redirect('/fiches')->withSuccess('Nouvelle fiche envoyée');
    }

    public function listAdresse()
    {
        return view('Magasinier.listeAdresses');
    }

    public function ajaxListeAdresses(Request $request)
    {
        $des = $request->filtre;
        $list = Article_Adresse::getListArtAdresse($des);
        return view('Magasinier.ajaxliste-Adresses', ['val' => $list]);
    }
}
