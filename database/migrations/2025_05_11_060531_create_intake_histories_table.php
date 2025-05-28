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
        Schema::create('intake_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('food_name');
            $table->float('calories');
            $table->float('protein');
            $table->float('carbs');
            $table->float('fat');
            $table->enum('meal_time',['Sarapan', 'Makan Siang', 'Makan Malam', 'Camilan']);
            $table->timestamp('consumed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('intake_histories');
    }
};
