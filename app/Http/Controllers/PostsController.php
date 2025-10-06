<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostsController extends Controller
{

  public function index(){
    $posts = Post::all(); // または適宜 paginate() でもOK
    return view('posts.index', compact('posts'));
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

  public function update(Request $request, $id){
    $request->validate(['post' => ['required', 'min:1', 'max:150'],]);
    $post = Post::findOrFail($id);
    $post->post = $request->input('post');
    $post->save();
    return redirect()->route('posts.index')->with('success', '投稿を更新しました。');
  }

  public function destroy(post $post){
    $post->delete();
    return redirect('index');
  }
}
