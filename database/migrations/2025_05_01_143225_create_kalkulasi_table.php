<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kalkulasi', function (Blueprint $table) {
            $table->id();
            $table->integer('usia');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->float('berat_badan');
            $table->float('tinggi_badan');
            $table->string('tingkat_aktivitas');
            $table->float('faktor_aktivitas');
            $table->string('tujuan');
            $table->float('kalori_harian');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kalkulasi');
    }
};
