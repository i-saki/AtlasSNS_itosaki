<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class PostsController extends Controller
{

  public function index(){
    $FollowUserID = Auth::user()->followings->pluck('id')->push(Auth::id());
    $Follow_post = Post::whereIn('user_id',$FollowUserID)->latest()->get();
    $Modal_id = Post::whereIn('user_id',$FollowUserID)->first();

    return view('posts.index', [
        'postID' => $Follow_post,
        'modalID' => $Modal_id,
        ]);
  }




  public function store(Request $request){
    // バリデーション
    $request->validate(['description' => 'required|string|min:1|max:150', // indexフォームの name 属性と一致させるdescription
    ]);
    // データベースに保存
    Post::create([
        'user_id' => auth()->id(), // 現在ログインしているユーザーのIDを取得
        'post' => $request->input('description'), // 'description' に統一
    ]);
    // index ページへリダイレクト
    return redirect('index');
    }

  public function update(Request $request){
    $id = $request->input('id');
    $request->validate(['upPost' => ['required', 'min:1', 'max:150'],]);
    $post = Post::findOrFail($id);
    $post->post = $request->input('upPost');
    $post->save();
    return redirect('/index');
  }

  public function destroy(post $post){
    $post->delete();
    return redirect('index');
  }
}
