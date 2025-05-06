<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SimulasiDefisit extends Model
{
    use HasFactory;

    protected $table = 'simulasi_defisit'; // Nama tabel di database

    protected $fillable = [
        'user_id',
        'target_berat',
        'durasi',
        'tingkat_aktivitas',
        'kebutuhan_kalori', // Tambahkan kebutuhan_kalori di sini
    ];
}