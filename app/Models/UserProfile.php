<?php

// app/Models/UserProfile.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $fillable = [
        'user_id', 'age', 'gender', 'height', 'weight', 
        'activity_level', 'is_vegetarian', 'is_low_calorie', 
        'is_gluten_free', 'profile_photo_path'
    ];

    protected $casts = [
        'is_vegetarian' => 'boolean',
        'is_low_calorie' => 'boolean',
        'is_gluten_free' => 'boolean',
    ];
}