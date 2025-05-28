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
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('name');
            $table->float('calories')->nullable();
            $table->float('protein')->nullable();
            $table->float('carb')->nullable();
            $table->float('fat')->nullable();
            $table->enum('nutrition_type', ['Diet', 'Tinggi Protein', 'Rendah Kalori', 'Vegetarian'])->nullable();
            $table->integer('time')->nullable(); 
            $table->text('ingridients');
            $table->text('steps');
            $table->string('image')->nullable(); 
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
