<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kalkulasi extends Model
{
    use HasFactory;

    protected $table = 'kalkulasi';

    protected $fillable = [
        'usia',
        'jenis_kelamin',
        'berat_badan',
        'tinggi_badan',
        'tingkat_aktivitas',
        'faktor_aktivitas',
        'tujuan',
        'kalori_harian'
    ];
}