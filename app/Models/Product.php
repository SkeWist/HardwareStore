<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'cost',
        'photo',
        'category_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    // Связи
    public function category() {
        return $this->belongsTo(Category::class);
    }
}
