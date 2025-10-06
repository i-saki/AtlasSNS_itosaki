<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()//ユーザーの認証チェック

    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()//バリデーションルール設定
    {
        return [
            'username' =>'required|min:2|max:12',
            'email' =>'required|min:5|max:40|unique:users|email|',
            'password' =>'required|min:8|max:20|alpha_dash|confirmed',
            //'password_confirmation' =>'required|min:8|max:20|alpha_dash|confirmed',
        ];
    }

}
