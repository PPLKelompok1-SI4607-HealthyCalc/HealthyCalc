<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'recipes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama_resep',
        'bahan',
        'langkah',
        'kalori',
        'protein',
        'karbo',
        'lemak',
        'waktu_masak',
        'tag_nutrisi',
        'image',
    ];
}