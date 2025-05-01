<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodLog extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dari konvensi plural nama model
    protected $table = 'food_logs'; 


    protected $fillable = [
        'food_name', 'portion', 'calories', 'protein', 'carbs', 'fat', 'consumed_at'
    ];

 
    protected $casts = [
        'consumed_at' => 'datetime',
    ];


    public $timestamps = true;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public static function allFoodLogs()
    {
        return self::orderByDesc('consumed_at')->get();
    }
}
