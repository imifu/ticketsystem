<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserMailRequest extends FormRequest
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

            'user_id'     => 'required', // 必須
            'mail_id'      => 'required', // 必須
            'send_flg' => 'required', // 必須
            'del_flg' => 'required', // 必須

        ];
    }
}
