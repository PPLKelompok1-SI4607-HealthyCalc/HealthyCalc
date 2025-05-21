<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pantangan extends Model
{
    use HasFactory;

    protected $fillable = ['nama_makanan', 'kategori'];
}

