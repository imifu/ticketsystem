<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Scopes\TicketDelFlgScope;

class Ticket extends Model
{
    use HasFactory;

    // 許可カラムを指定する
    protected $fillable = [
        'title',
        'ticket_explain',
        'image',
        'image2',
        'image3',
        'show_flg',
        'reco_flg',
        'sold_out_flg',
        'show_from',
        'show_to',
        'receive_from',
        'receive_to',
        'open_date',
        'close_date',
        'open_time',
        'close_time',
        'open_date_text',
        'receive_date_text',
        'owner_name',
        'live_name',
        'place_name',
        'place',
        'access',
        'order_num',
    ];

    protected $hidden = [

    ];

    protected $casts = [

    ];

    // DelFlgScopeを適用する
    protected static function booted()
    {
        static::addGlobalScope(new TicketDelFlgScope);
    }
}
