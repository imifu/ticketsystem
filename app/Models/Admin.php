<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Authコンポーネント使用
use Illuminate\Foundation\Auth\User;

use App\Models\Scopes\DelFlgScope;

class Admin extends User
{
    use HasFactory;

    // 許可カラムを指定する
    protected $fillable = [
        'name',
        'email',
        'password',
        'admin_flg',
        'email_verified_at'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // DelFlgScopeを適用する
    protected static function booted()
    {
        static::addGlobalScope(new DelFlgScope);
    }


}
