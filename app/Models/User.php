<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

     public function post(){
        return $this->hasMany('App\Models\Post');}





    protected $guarded = [];

    public function getSearchResult(): SearchResult
    {
        // A.検索結果のリンク先となるルートを入れる
       $url = route('search.index', $username->id);

        return new SearchResult(
           $username,
        //    B.検索結果で表示したいカラムを入れる
           $username->icon_image,
           $url
        );
    }

    public function getIconUrlAttribute()
    {
        // 例えば画像が保存されてるパスが images/username.png の場合
        return asset('storage/icons/' . $this->icon1 . '.png');
    }


    // ユーザーがフォローしている
    public function followings()
    {
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'followed_id');
    }

    // フォローされている（フォロワー）
    public function followed()
    {
        return $this->belongsToMany(User::class, 'follows', 'followed_id', 'following_id');
    }

    // フォローしているか？
    public function isFollowing(User $user)
    {
        return $this->followings()->where('followed_id', $user->id)->exists();//←メソッドが定義されているかどうかを調べます。わざわコントーローラーに行かなくて済んでいる。
    }

}
