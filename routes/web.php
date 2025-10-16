<?php
//ログイン中

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\FollowsController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



require __DIR__ . '/auth.php';

Route::get('/', function () {
    return view('welcome'); // 誰でもアクセス可能
});

// ✅ 認証が必要なページ（未ログインなら `/login` にリダイレクト）
Route::middleware(['auth'])->group(function () {


//登録完了表示
    Route::get('added', [RegisteredUserController::class, 'added']);


     //トップ画面表示
    Route::get('index', [PostsController::class, 'index'])->name('posts.index');
     //投稿処理
    Route::post('index', [PostsController::class, 'store'])->name('posts.create');
     //更新処理
    Route::post('/postUpdate', [PostsController::class, 'update'])->name('posts.update');
     //投稿削除処理
    Route::delete('posts/{post}', [PostsController::class, 'destroy'])->name('posts.destroy');

    //ユーザー検索ページ
    Route::get('/search', [UsersController::class, 'search'])->name('search');
    //フォローリストページ
    Route::get('/followlist', [FollowsController::class, 'followList'])->name('follow.list');
    //フォロワーリストページ
    Route::get('/followerlist', [FollowsController::class, 'followerList'])->name('follower.list');
    //相手ユーザーのプロフィールページ
    Route::get('users/{id}/profile', [ProfileController::class, 'profiles'])->name('profile.show');
    //自分のプロフィールページ
    Route::get('profiles/profile', [ProfileController::class, 'profile']);
    //プロフィール変更処理
    Route::post('profiles/profile', [ProfileController::class, 'profileUpdate'])->name
    ('profileForm');


    // フォロー（POST）
    Route::post('/follow/{id}', [FollowsController::class, 'follow'])->name('follows.toggle');
    //フォロー解除
    Route::post('/unfollow/{id}',[FollowsController::class,'unfollow'])->name('follows.unfollow');



});
//こうすることで、ログインしてないユーザーはリダイレクトされて、フォロー処理にアクセスできません。

Auth::routes();
