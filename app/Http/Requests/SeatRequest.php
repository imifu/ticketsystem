<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeatRequest extends FormRequest
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
            'ticket_id'     => 'required', // 必須
            'ticket_name'      => 'required', // 必須
            'amount'      => 'required', // 必須
            'commission'      => 'required', // 必須
            'deray_payment_date' => 'required', // 必須
            'ticket_amount' => 'required', // 必須
            'sold_out_flg' => 'required', // 必須
        ];
    }
}
