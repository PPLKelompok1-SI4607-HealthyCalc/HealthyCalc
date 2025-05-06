<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $table = 'user_profiles';

    protected $fillable = [
        'user_id',
        'age',
        'gender',
        'height',
        'weight',
        'activity_level',
        'is_vegetarian',
        'is_low_calorie',
        'is_gluten_free',
        'profile_photo_path',
    ];

    protected $casts = [
        'is_vegetarian' => 'boolean',
        'is_low_calorie' => 'boolean',
        'is_gluten_free' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
