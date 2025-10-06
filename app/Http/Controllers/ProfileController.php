<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;

use App\Models\User;//登録ユーザーのDBを使用
use App\Models\Post;

class ProfileController extends Controller
{
    public function profiles($id){
        $otherUser= User::findOrFail($id);
        $postID = Post::where('user_id',$id)->get();
        return view('users.profile',[
            'otherUser'=> $otherUser,
            'postId' => $postID,
        ]);
    }

    public function profile(){
        $User= Auth::user();
        return view('profiles.profile');
    }

public function profileUpdate(Request $request){
        $request->validate([
            'upUsername' => 'required|between:2,12',
            'upMail' => 'required|between:5,40|email|unique:users,email,' .Auth::user()->email. ',email',
            'upPassword' => 'required|regex:/^[a-zA-Z0-9]+$/|between:8,20|confirmed',
            'upBio' => 'max:150',
            'upIcon' => 'image|mimes:jpg,png,bmp,gif,svg',
        ]);
        $id = Auth::id();
        $up_username = $request->input('upUsername');
        $up_mail = $request->input('upMail');
        $up_password = $request->input('upPassword');
        $hash_up_password = Hash::make($up_password);
        $up_bio = $request->input('upBio');
            User::where('id',$id)->update([
                'username' => $up_username,
                'email' => $up_mail,
                'password' => $hash_up_password,
                'bio' => $up_bio,
        ]);
        if ($request->hasFile('upIcon')) {
            $file = $request->file('upIcon');
            $fileName = $file->getClientOriginalName();
            $file->storeAs('public/images', $fileName);
            User::where('id', $id)->update(['icon_image' => $fileName]);
        }
        return redirect('/index');
    }

}
