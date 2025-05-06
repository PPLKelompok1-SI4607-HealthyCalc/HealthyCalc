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
            $table->string('tingkat_aktivitas')->default('rendah')->change(); // Tambahkan nilai default 'rendah'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('simulasi_defisit', function (Blueprint $table) {
            $table->string('tingkat_aktivitas')->change(); // Kembalikan ke kondisi awal tanpa default
        });
    }
};
