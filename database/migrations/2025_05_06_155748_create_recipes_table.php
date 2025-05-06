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
            $table->integer('kalori')->nullable();
            $table->integer('protein')->nullable();
            $table->integer('karbo')->nullable();
            $table->integer('lemak')->nullable();
            $table->string('waktu_masak')->nullable();
            $table->string('tag_nutrisi')->nullable();
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