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
        // Session::forget('designation');
        $designation = null;
        $fournisseur = null;
        $proposition = null;
        $AR_Ref = Session::get('designation');
        $CT_Num = Session::get('fournisseur');
        if ($AR_Ref != null) {
            $designation = DB::table('F_ARTICLE')
                ->Where("AR_Ref", "=", $AR_Ref)
                ->select('F_ARTICLE.*')
                ->get();

            $split = str_split($AR_Ref);
            $proposition = DB::table('formes')
                ->Where("FO_ref", "=", $split[10])
                ->select('formes.*')
                ->get();
        }
        if ($CT_Num != null) {
            $fournisseur = DB::table('F_COMPTET')
                ->Where("CT_Num", "=", $CT_Num)
                ->select('F_COMPTET.*')
                ->get();
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
        $article = DB::table('F_ARTICLE')
            ->join('F_FAMILLE', 'F_ARTICLE.FA_CodeFamille', '=', 'F_FAMILLE.FA_CodeFamille')
            ->orWhere('AR_Design', 'like', '%' . $des . '%')
            ->orWhere('AR_Ref', 'like', '%' . $des . '%')
            ->groupBy('F_ARTICLE.AR_Ref', 'F_ARTICLE.FA_CodeFamille', 'F_ARTICLE.AR_Design', 'F_ARTICLE.cbMarq', 'F_FAMILLE.FA_Intitule')
            ->select('F_ARTICLE.*', 'F_FAMILLE.FA_Intitule');
        $val = $article->paginate(10);
        return view('Magasinier.ajaxliste-Articles', ['val' => $val]);
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
        $fournisseur = DB::table('F_COMPTET')
            ->Where('CT_Intitule', 'like', '%' . $filtre . '%')
            ->Where('CT_Type', '=', 1)
            ->select('F_COMPTET.*');
        $val = $fournisseur->paginate(10);
        return view('Magasinier.ajaxliste-Frns', ['val' => $val]);
    }

    public function setSessionFrns($CT_Num)
    {
        $value = $CT_Num;
        Session::put('fournisseur', $value);
        return redirect('/fiche-create');
    }

    public function split($mot)
    {
        $split = str_split($mot);
        echo ($split[10]);
    }

    public function storeFiche(Request $request)
    {
        $validator = Validator::make($request->all(),  [
            'AR_Ref' => ['required'],
            'CT_Num' => ['required'],
            'lot' => ['required'],
        ],
        [
            'AR_Ref.required' => 'Veuillez  remplir la designation',
            'CT_Num.required' => 'Veuillez  remplir le fournisseur',
            'lot.required' => 'Veuillez  remplir le lot',
        ]);
        
        if($validator->fails()){
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
            $details = [
                'id_Fiche' => $id_Fiche,
                'AR_Design' =>  $request->design,
                'date' => now()
            ];
            $users = User::where('post_id', 3)
                ->get();
            foreach ($users as $user) {
                Mail::to($user)->send(new mailNotification($details));
            }
        }

        Session::forget('designation');
        Session::forget('fournisseur');

        return redirect()->back()->withSuccess('Nouvelle fiche enregistrer');
    }

    public function AjaxListeFiche(Request $request)
    {
        $des = $request->filtre;
        $list = null;
        $list = DB::table('fiche_details_fiche')
            ->Where('AR_Design', 'like', '%' . $des . '%')
            ->Where('etat', '=', 0)
            ->groupBy('id_Fiche', 'AR_Ref', 'AR_Design', 'CT_Intitule', 'date_controle', 'position', 'etat')
            ->select("id_Fiche", "AR_Ref", "AR_Design", "CT_Intitule", DB::raw("sum(quantite) as total"), "date_controle", "Etat", "position");
        $val = $list->paginate(10);

        return view('Magasinier.ajaxliste-Fiches', ['val' => $val]);
    }

    public function ajoutLot($id_Fiche)
    {
        $details = DB::table('fiche_details_fiche')
            ->orWhere('id_Fiche', '=', $id_Fiche)
            ->limit(1)
            ->select('fiche_details_fiche.*')
            ->get();

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
        DB::update("update details_Fiche set etat = 1 where id_Fiche = " . $id_Fiche);
        return redirect('/fiches')->withSuccess('Nouvelle fiche enregistrer');
    }

    public function listAdresse(){
        return view('Magasinier.listeAdresses');
    }

    public function ajaxListeAdresses(Request $request)
    {
        $des = $request->filtre;
        $adresse = DB::table('articles_Adresses')
            ->orWhere('DP_Code', 'like', '%' . $des . '%')
            ->orWhere('DP_Intitule', 'like', '%' . $des . '%')
            ->orWhere('AR_Ref', 'like', '%' . $des . '%')
            ->select('articles_Adresses.*');
        $val = $adresse->paginate(15);
        return view('Magasinier.ajaxliste-Adresses', ['val' => $val]);
    }
}
