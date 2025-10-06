<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\PostsController;

class Post extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    protected $fillable = [
        'user_id',
        'post',
        'created_at',
        'updated_at'];

    public function findAllPosts(){
        return Post::all();
    }

    /**
     * 登録処理
     */
    public function InsertPost($request){
        // リクエストデータを基に管理マスターユーザーに登録する
        return $this->create([
        'post_name' => $request->post_name,
        ]);
    }

}
