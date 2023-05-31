<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class mailRequest extends FormRequest
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
            'message'      => 'required', // 必須
            'send_time' => 'required', // 必須

        ];
    }
}
