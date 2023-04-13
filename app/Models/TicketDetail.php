<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Scopes\TicketDetailDelFlgScope;

class TicketDetail extends Model
{
    use HasFactory;

    // 許可カラムを指定する
    protected $fillable = [
        'ticket_id',
        'ticket_name',
        'amount',
        'ticket_amount',
        'sold_out_flg'
    ];

    protected $hidden = [

    ];

    protected $casts = [

    ];

    // DelFlgScopeを適用する
    protected static function booted()
    {
        static::addGlobalScope(new TicketDetailDelFlgScope);
    }
}
