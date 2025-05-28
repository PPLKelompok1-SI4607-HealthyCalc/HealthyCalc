<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Relasi ke tabel user_profiles
    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }

    // Relasi ke tabel communities
    public function communities()
    {
        return $this->hasMany(Community::class);
    }

    // Relasi ke tabel food_plannings
    public function foodPlannings()
    {
        return $this->hasMany(FoodPlanning::class);
    }

    // Relasi ke tabel taboo_foods
    public function tabooFoods()
    {
        return $this->hasMany(TabooFood::class);
    }

    // Relasi ke tabel suplemens
    public function suplemens()
    {
        return $this->hasMany(Suplemen::class);
    }

    // Relasi ke tabel activities
    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    // Relasi ke tabel intake_histories
    public function intakeHistories()
    {
        return $this->hasMany(IntakeHistory::class);
    }

    // Relasi ke tabel recipes
    public function recipes()
    {
        return $this->hasMany(Recipe::class);
    }

    // Relasi ke tabel simulations
    public function simulations()
    {
        return $this->hasMany(Simulation::class);
    }
    

}
