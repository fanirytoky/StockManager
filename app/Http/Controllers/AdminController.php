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

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function createUser()
    {
        $post = Post::all();
        return view('createUser',compact('post'));
    }

    public function users()
    {
        return view('listeUser');
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'post_id' => ['required'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],

        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'post_id' => $request->post_id,
        ]);

        event(new Registered($user));

        return redirect('/users');
    }

    public function ajaxListeUser(Request $request){
        $des = $request->filtre;
        $liste = User::getUtilisateurs($des);
        return view('ajaxlisteUser', ['val' => $liste]);
    }

    public function updateUser($id){
        $val = User::getUtilisateur($id);
        $post = Post::all();
        return view('update-user', ['post' =>$post , 'user_post' => $val]);
    }

    public function deleteUser($id){
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
        if(strcmp($user->email,$request->email) == 0){
            $user->update([
                'name' => $request->name,
                'password' => Hash::make($request->password),
                'post_id' => $request->post_id,
            ]); 
        }
        else{
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'post_id' => $request->post_id,
        ]);
        }
        return redirect('/users');
    }

}
