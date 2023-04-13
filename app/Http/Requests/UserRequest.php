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
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name'     => 'required', // 必須
            'last_name'     => 'required', // 必須
            'sex'     => 'required', // 必須
            'email'      => 'required|email', // 必須
            'password' => 'required|min:8|confirmed', // 必須
            'password_confirmation' => 'min:8', // 必須
            'tel'     => 'required', // 必須
            'post_code'     => 'required', // 必須
            'pref'     => 'required', // 必須
            'address'     => 'required', // 必須
  
        ];
    }

    public function messages()
    {
        return [
            'email.email'  => 'メールアドレスが正しいか確認して入力して下さい',
            'email.required' => 'メールアドレスが正しいか確認して入力して下さい',
            'password.min' => 'パスワードは8文字以上で入力してください',
            'password.confirmed' => 'パスワードが一致しません',
        ];
    }
}
