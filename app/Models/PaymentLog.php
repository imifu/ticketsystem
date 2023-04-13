<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentLog extends Model
{
    use HasFactory;

    // 許可カラムを指定する
    protected $fillable = [
        'user_id',
        'user_ticket_id',
        'stripe_id',
        'email',
        'amount',
        'payment_date',
    ];

}
