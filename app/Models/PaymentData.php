<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentData extends Model
{
    use HasFactory;

    protected $table = 'payment_datas';

    // 許可カラムを指定する
    protected $fillable = [
        'user_ticket_id',
        'ticket_id',
        'ticket_detail_id',
        'payment_log_id',
        'amount',
        'payment_date',
    ];
}
