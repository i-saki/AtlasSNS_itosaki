<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class UsersController extends Controller
{
    public function search(Request $request){
        $currentUserId = auth()->id();// ログイン中のユーザーIDを取得
        $query = User::query();// $queryを初期化
        if ($request->filled('keyword')) {// 検索ワードがある場合、部分一致で検索
            $query->where(
                'username',
                'like',
                '%' . $request->input('keyword') . '%'
            );}
        $query->where('id', '!=', $currentUserId);// ログインユーザーを除外
        $users = $query->get();// 検索結果または全ユーザーを取得
        return view('users.search',
            ['users' => $users,
             'user' => auth()->user(), // 👈 これを追加！
            ]);// 3つ目の処理：リダイレクトでindexのURLを指定して、ユーザーの一覧ページを画面表示するルーティング
    }

}
