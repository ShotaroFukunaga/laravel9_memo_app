<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    use HasFactory;

    // protected $table = 'tweet';スネークケースかつ複数形ではない場合、明示的に紐つけする必要がある。
}

// 主キーの名前がidでは無くtweet_idだった場合
// protected $prymaryKey = 'tweet_id';

// 主キーが増分整数ではない場合（オートインクリメントが必要ない場合）
// public $incrementing = false;

// 主キーが整数方では無い場合
// protected $keyType = 'string';

// created_at,updated_atが不要な場合
// public $timestamps = false;

// 対応するカラム名を指定する場合
// const CREATED_AT = 'creation_date';
// const UPDATED_AT = 'updated_date';