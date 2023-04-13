<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTicket extends Model
{
    use HasFactory;

    // 許可カラムを指定する
    protected $fillable = [
        'ticket_id',
        'ticket_detail_id',
        'user_id',
        'qr_code',
        'amount',
        'valid_flg',
        'payment_flg',
        'seat',
        'come_flg',
    ];

    protected $hidden = [

    ];

    protected $casts = [

    ];

    // DelFlgScopeを適用する
    protected static function booted()
    {
        // static::addGlobalScope(new TicketDetailDelFlgScope);
    }
}
