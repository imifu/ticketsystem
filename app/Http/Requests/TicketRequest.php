<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest
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
            'ticket_explain'      => 'required', // 必須
            // 'image' => 'required', // 必須
            // 'image2' => 'required', // 必須
            // 'image3'     => 'required', // 必須
            'show_flg'      => 'required', // 必須
            'reco_flg' => 'required', // 必須
            'sold_out_flg' => 'required', // 必須
            'show_from'     => 'required', // 必須
            'show_to'      => 'required', // 必須
            'receive_from' => 'required', // 必須
            'receive_to' => 'required', // 必須
            'open_date'     => 'required', // 必須
            'close_date'      => 'required', // 必須
            // 'open_time' => 'required', // 必須
            // 'close_time' => 'required', // 必須
            'owner_name'     => 'required', // 必須
            'live_name'      => 'required', // 必須
            'place_name'      => 'required', // 必須
            'place' => 'required', // 必須
            'access' => 'required', // 必須
            'order_num'     => 'required', // 必須
        ];
    }
}
