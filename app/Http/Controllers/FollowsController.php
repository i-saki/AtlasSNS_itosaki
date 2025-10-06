<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Follow;//Followモデルをインポート
use Illuminate\Support\Facades\Auth; // Authファサードを読み込む
use App\Models\User;
use App\Models\Post;


class FollowsController extends Controller
{

public function followList(){
    $follow_user = Follow::where('following_id',Auth::id())->pluck('followed_id');
    $follow_icon = User::whereIn('id',$follow_user)->get();
    $follow_post = Post::whereIn('user_id',$follow_user)->latest()->get();
    return view('follows.followList', [
        'users' => $follow_icon,
        'posts' => $follow_post,
    ]);
}


public function followerList(){
    $follow_user = Follow::where('followed_id',Auth::id())->pluck('following_id');
    $follow_icon = User::whereIn('id',$follow_user)->get();
    $follow_post = Post::whereIn('user_id',$follow_user)->latest()->get();
    return view('follows.followerList', [
        'users' => $follow_icon,
        'posts' => $follow_post,
    ]);
}


//フォローする。
public function follow(Request $request){
//引数の $id を受け取り、フォロー対象のユーザーを取得<IDが存在しなければ404
    Follow::create([
        'following_id' => Auth::id(),
        'followed_id' => $request->id,
        ]);
    return back();//前の画面に戻って、フォローボタンの状態を自動で更新
}


//フォローを外す
public function unfollow(Request $request){
    Follow::where('followed_id', $request->id)//Followテーブルにいる相手
        ->where('following_id', Auth::id())//ログインしている自分
        ->delete();
    return back();
}
}
