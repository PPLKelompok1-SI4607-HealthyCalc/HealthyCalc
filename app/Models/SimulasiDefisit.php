<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SimulasiDefisit extends Model
{
    use HasFactory;

    protected $table = 'simulasi-defisit';

    protected $fillable = [
        'target_berat',
        'durasi',
        'tingkat_aktivitas',
        'kebutuhan_kalori',
        'rekomendasi_aktivitas',
    ];
}