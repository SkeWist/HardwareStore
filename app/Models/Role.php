<?php

namespace App\Models;

use App\Http\Controllers\UserController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'name'];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    // Связи
    public function users() {
        return $this->hasMany(User::class);
    }
}
