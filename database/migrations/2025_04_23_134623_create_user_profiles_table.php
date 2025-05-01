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
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // relasi ke tabel users
            $table->integer('age')->nullable(); // umur
            $table->string('gender')->nullable(); // Laki-laki, Perempuan, Lainnya
            $table->integer('height')->nullable(); // tinggi dalam cm
            $table->decimal('weight', 5, 2)->nullable(); // berat dalam kg
            $table->string('activity_level')->nullable(); // Sangat Aktif, Cukup Aktif, Kurang Aktif
            $table->boolean('is_vegetarian')->default(false);
            $table->boolean('is_low_calorie')->default(false);
            $table->boolean('is_gluten_free')->default(false);
            $table->string('profile_photo_path')->nullable(); // opsional: path foto profil
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
