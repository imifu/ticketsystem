<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Scopes\UserMailDelFlgScope;

class UserMail extends Model
{
    use HasFactory;

    // 許可カラムを指定する
    protected $fillable = [
        'user_id',
        'mail_id',
        'send_flg',
        'del_flg'
    ];

    protected $hidden = [];

    protected $casts = [];

    // DelFlgScopeを適用する
    protected static function booted()
    {
        static::addGlobalScope(new UserMailDelFlgScope);
    }
}
