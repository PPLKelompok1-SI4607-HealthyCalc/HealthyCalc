<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FoodIntake extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'food_name',
        'calories',
        'protein',
        'carbs',
        'fat',
        'meal_time',
        'consumed_at',
    ];

    // Relasi ke tabel users
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
