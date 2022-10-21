<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function createUser()
    {
        $post = Post::all();
        return view('createUser', compact('post'));
    }

    public function users()
    {
        return view('listeUser');
    }

    public function storeUser(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'post_id' => ['required'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],

            ],
            [
                'name.required' => 'Veuillez remplir le nom',
                'email.required' => "Veuiller remplir l'email",
                'password.required' => 'Veuillez remplir le mot de passe',
                'password.confirmed' => 'Veuillez confirmer le bon Mot de passe',
            ]
        );

        if ($validator->fails()) {
            return  redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'post_id' => $request->post_id,
        ]);

        event(new Registered($user));

        return redirect('/users');
    }

    public function ajaxListeUser(Request $request)
    {
        $des = $request->filtre;
        $liste = User::getUtilisateurs($des);
        return view('ajaxlisteUser', ['val' => $liste]);
    }

    public function updateUser($id)
    {
        $val = User::getUtilisateur($id);
        $post = Post::all();
        return view('update-user', ['post' => $post, 'user_post' => $val]);
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('/users');
    }

    public function modifierUser(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'post_id' => ['required'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::find($request->idUser);
        if (strcmp($user->email, $request->email) == 0) {
            $user->update([
                'name' => $request->name,
                'password' => Hash::make($request->password),
                'post_id' => $request->post_id,
            ]);
        } else {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'post_id' => $request->post_id,
            ]);
        }
        return redirect('/users');
    }

    public function maj()
    {
        return view('maj');
    }

    public function majExecute($table)
    {
        if ($table == 0) {
            DB::statement("
        SET
            IDENTITY_INSERT F_ARTICLE ON;

        Merge [reception_salama].[dbo].[F_ARTICLE] as TargetArticle using [SAGEAGJ].[dbo].[F_ARTICLE] as SourceArticle ON TargetArticle.cbMarq = SourceArticle.cbMarq
        when not matched by target then
        insert
            (AR_ref, AR_Design, FA_CodeFamille, cbMarq)
        values
            (
                SourceArticle.AR_ref,
                SourceArticle.AR_Design,
                SourceArticle.FA_CodeFamille,
                SourceArticle.cbMarq
            );

        SET
            IDENTITY_INSERT F_ARTICLE OFF;
        ");
        }
        if ($table == 1) {

            DB::statement("SET
                IDENTITY_INSERT F_COMPTET ON;

            Merge [reception_salama].[dbo].[F_COMPTET] as TargetFrns using [SAGEAGJ].[dbo].[F_COMPTET] as SourceFrns ON TargetFrns.cbMarq = SourceFrns.cbMarq
            when not matched by target then
            insert
                (CT_Num, CT_Intitule, CT_Type, cbMarq)
            values
                (
                    SourceFrns.CT_Num,
                    SourceFrns.CT_Intitule,
                    SourceFrns.CT_Type,
                    SourceFrns.cbMarq
                );

            SET
                IDENTITY_INSERT F_COMPTET OFF;
            ");
        }
        if ($table == 2) {
            DB::statement("SET
                IDENTITY_INSERT F_ARTSTOCKEMPL ON;
            
            Merge [reception_salama].[dbo].[F_ARTSTOCKEMPL] as TargetArticle using [SAGEAGJ].[dbo].[F_ARTSTOCKEMPL] as SourceArticle ON TargetArticle.CbMarq = SourceArticle.CbMarq
            when not matched by target then
            insert
                (
                    [AR_Ref],
                    [DE_No],
                    [DP_No],
                    [cbMarq]
                )
            values
                (
                    sourceArticle.[AR_Ref],
                    sourceArticle.[DE_No],
                    sourceArticle.[DP_No],
                    sourceArticle.[cbMarq]
                );
            
            SET
                IDENTITY_INSERT F_COMPTET OFF");
        }
        if ($table == 3) {
            DB::statement("SET
                    IDENTITY_INSERT F_DEPOT ON;
            
            Merge [reception_salama].[dbo].[F_DEPOT] as TargetArticle using [SAGEAGJ].[dbo].[F_DEPOT] as SourceArticle ON TargetArticle.cbMarq = SourceArticle.cbMarq
            when not matched by target then
            insert
                    (
                        [DE_No],
                        [DE_Intitule],
                        [DE_Adresse],
                        [DE_Ville],
                        [DE_Region],
                        [DE_Pays],
                        [DE_EMail],
                        [DE_Telephone],
                        [cbMarq]
                    )
            values
                    (
                        SourceArticle.[DE_No],
                        SourceArticle.[DE_Intitule],
                        SourceArticle.[DE_Adresse],
                        SourceArticle.[DE_Ville],
                        SourceArticle.[DE_Region],
                        SourceArticle.[DE_Pays],
                        SourceArticle.[DE_EMail],
                        SourceArticle.[DE_Telephone],
                        SourceArticle.[cbMarq]
                    );
            
            SET
                    IDENTITY_INSERT F_DEPOT OFF
                    SET
                    IDENTITY_INSERT F_DEPOTEMPL ON;

                Merge [reception_salama].[dbo].[F_DEPOTEMPL] as TargetArticle using [SAGEAGJ].[dbo].[F_DEPOTEMPL] as SourceArticle ON TargetArticle.CbMarq = SourceArticle.CbMarq
                when not matched by target then
                insert
                    (
                            [DE_No],
                            [DP_No],
                            [DP_Code],
                            [DP_Intitule],
                            [cbMarq]
                    )
                values
                    (
                            sourceArticle.[DE_No],
                            sourceArticle.[DP_No],
                            sourceArticle.[DP_Code],
                            sourceArticle.[DP_Intitule],
                            sourceArticle.[cbMarq]
                    );

                SET
                    IDENTITY_INSERT F_DEPOTEMPL OFF");
        }

        return  redirect()->back()->withErrors("Mise à jour réussie")->withInput();
    }
}
