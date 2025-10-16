<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class UsersController extends Controller
{
    public function search(Request $request){
        $currentUserId = auth()->id();
    $keyword = $request->input('keyword');

    $users = User::when($keyword, function ($query, $keyword) {
            $query->where('username', 'like', '%' . $keyword . '%');
        })
        ->where('id', '!=', $currentUserId)
        ->get();

    return view('users.search', [
        'users' => $users,
        'user' => auth()->user(),
    ]);
}
}
