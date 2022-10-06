<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    const UPDATED_AT = null;
    const CREATED_AT = null;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'post_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        // 'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];

    public function getUtilisateurs($des)
    {
        $post = DB::table('users')
            ->join('posts', 'users.post_id', '=', 'posts.id')
            ->orWhere('name', 'like', '%' . $des . '%')
            ->orWhere('email', 'like', '%' . $des . '%')
            ->select('users.*', 'posts.titre_post');
        $val = $post->paginate(6);
        return $val;
    }

    public function getUtilisateur($id)
    {
        $user = DB::table('users')
            ->join('posts', 'users.post_id', '=', 'posts.id')
            ->where('users.id', '=', $id)
            ->select('users.*', 'posts.titre_post')
            ->get();
        return $user;
    }
}
