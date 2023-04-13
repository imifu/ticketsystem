<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
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
            'title'     => 'required', // 必須
            'reco_flg'      => 'required', // 必須
            'header_text' => 'required', // 必須
            'detail' => 'required', // 必須
  
        ];
    }

    // public function messages()
    // {
    //     return [
    //         'name.required'     => '管理者名は必ず入力して下さい。',
    //         'email.email'  => 'メールアドレスが正しいか確認して入力して下さい',
    //         'email.required' => 'メールアドレスが正しいか確認して入力して下さい',
    //         'password.min' => 'パスワードは8文字以上で入力してください',
    //         'password.required' => 'パスワードは必ず入力してください',
    //         'password_confirmation.min' => 'パスワード確認は8文字以上で入力してください',
    //         'password.confirmed' => 'パスワードが一致しません',
    //     ];
    // }
}
