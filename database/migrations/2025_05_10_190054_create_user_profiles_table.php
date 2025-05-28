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
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('age')->nullable();
            $table->enum('gender', ['Laki-laki', 'Perempuan'])->nullable();
            $table->integer('height')->nullable();
            $table->integer('weight')->nullable();
            $table->enum('activity_level', ['Sangat Aktif', 'Cukup Aktif', 'Kurang Aktif'])->nullable();
            $table->string('photo')->nullable();
            $table->integer('max_calories')->nullable();
            $table->integer('max_potein')->nullable();
            $table->integer('max_carbs')->nullable();
            $table->integer('max_fat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};
