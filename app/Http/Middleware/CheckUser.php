<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
         if (!Auth::check()) {
            return redirect(route('login'));
        }
        //if (!$request->is('login') && !$request->is('register')) {
            //return redirect(route('login'));
        //}//ログアウト中にログインと登録以外のページにアクセスしたら、ログインページに進む
        return $next($request);
    }
}
