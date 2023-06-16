<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Scopes\DelFlgScope;


class MailTable extends Model
{
    use HasFactory;

    protected $table = 'mails';

    // 許可カラムを指定する
    protected $fillable = [
        'title',
        'message',
        'send_flg',
        'send_time',
        'del_flg'
    ];

    protected $hidden = [];

    protected $casts = [];

    // DelFlgScopeを適用する
    protected static function booted()
    {
        static::addGlobalScope(new DelFlgScope);
    }
}
