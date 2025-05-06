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
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->string('nama_resep');
            $table->text('bahan');
            $table->text('langkah');
            $table->integer('kalori');
            $table->integer('protein');
            $table->integer('carbs');
            $table->integer('fat');
            $table->integer('waktu_masak')->nullable(); // dalam menit, misalnya
            $table->string('tag_nutrisi')->nullable();
            $table->string('image')->nullable(); // untuk menyimpan nama file gambar
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};
