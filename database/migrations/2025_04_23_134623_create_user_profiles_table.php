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
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('age')->nullable();
            $table->string('gender')->nullable();
            $table->integer('height')->nullable(); // in cm
            $table->decimal('weight', 5, 2)->nullable(); // in kg
            $table->string('activity_level')->nullable(); // sangat_aktif, cukup_aktif, kurang_aktif
            $table->boolean('is_vegetarian')->default(false);
            $table->boolean('is_low_calorie')->default(false);
            $table->boolean('is_gluten_free')->default(false);
            $table->string('profile_photo_path')->nullable();
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
