<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    use HasFactory;
    
    protected $primaryKey = 'user_id'; // 実際にある主キー名に変更
    public $incrementing = false;      // 文字列型など自動増分でない場合
    protected $keyType = 'string';     // 主キーが文字列型の場合
    
    protected $guard = 'admin'; // 追加

    protected $fillable = [
        'user_id', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
