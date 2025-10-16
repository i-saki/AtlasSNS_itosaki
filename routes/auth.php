<?php
//ログアウト中のみ
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Requests\StorePost;
use Illuminate\Support\Facades\Route;
use App\Http\Requests\UserRequest;




Route::middleware('guest')->group(function () {

    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');//画面表示
    Route::post('login',[AuthenticatedSessionController::class, 'store']);//ログイン処理

    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');//画面表示
    Route::post('register', [RegisteredUserController::class, 'store']);//登録処理



// ログアウト先が/loginになるようにする！調べる。
});

Route::middleware('auth')->group(function () {

    //ログアウト
    Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

});
