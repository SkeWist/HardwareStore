<?php

namespace App\Models;

use \App\Models\Role;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Psy\Util\Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'surname',
        'name',
        'phone',
        'password',
        'role_id',
        'api_token',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];


    // Генерация токена авторизации
    public function generateToken() {
        return $this->createToken('AuthToken')->plainTextToken;
    }

    // Связи
    public function role() {
        return $this->belongsTo(\App\Models\Role::class);
    }
}
