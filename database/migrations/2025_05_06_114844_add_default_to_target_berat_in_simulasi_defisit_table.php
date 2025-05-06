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
        Schema::table('simulasi_defisit', function (Blueprint $table) {
            $table->float('target_berat')->default(0)->change(); // Tambahkan nilai default 0
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('simulasi_defisit', function (Blueprint $table) {
            $table->float('target_berat')->change(); // Kembalikan ke kondisi awal tanpa default
        });
    }
};
