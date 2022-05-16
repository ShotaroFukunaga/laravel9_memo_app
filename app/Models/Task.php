<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $dates = ['deadline'];
    
    public static $statusNames = [
        '未対応',
        '完了',
        '期限超過',
        '福永'
    ];

    public function getStatusNameAttribute(): string
    {
        return self::$statusNames[$this->status];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $fillable= [
        'title',
        'status',
        'content',
        'deadline'
    ];
    
}
