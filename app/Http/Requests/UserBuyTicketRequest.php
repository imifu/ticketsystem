<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserBuyTicketRequest extends FormRequest
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
            'ticket_detail_id'     => 'required', // 必須
            'payment_flg'      => 'required', // 必須
            'buy_num'      => 'required', // 必須
        ];
    }

    public function messages()
    {
        return [
            'ticket_detail_id.required'  => 'チケットが売り切れています',
            'payment_flg.required' => '決済方法を選択してください',
            'buy_num.required' => 'チケットの購入枚数を選択してください',
        ];
    }
}
