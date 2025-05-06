<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::dropIfExists('user_profiles'); // Hapus tabel lama jika ada

        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index(); // Relasi ke tabel users
            $table->integer('age')->nullable();
            $table->string('gender')->nullable();
            $table->integer('height')->nullable();
            $table->double('weight', 8, 2)->nullable();
            $table->string('activity_level')->nullable();
            $table->double('calorie_limit', 8, 2)->nullable();
            $table->double('protein_limit', 8, 2)->nullable();
            $table->double('carbs_limit', 8, 2)->nullable();
            $table->double('fat_limit', 8, 2)->nullable();
            $table->string('profile_photo_path')->nullable();
            $table->timestamps();

            // Foreign key ke tabel users
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};