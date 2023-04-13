<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Scopes\DelFlgScope;

class News extends Model
{
    use HasFactory;


    // 許可カラムを指定する
    protected $fillable = [
        'title',
        'reco_flg',
        'header_text',
        'detail'
    ];

    protected $hidden = [

    ];

    protected $casts = [

    ];

    // DelFlgScopeを適用する
    protected static function booted()
    {
        static::addGlobalScope(new DelFlgScope);
    }
    
}
