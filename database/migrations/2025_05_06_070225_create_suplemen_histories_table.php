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
        Schema::create('suplemen_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('suplemen_id')->references('id')->on('suplemens')->onDelete('cascade');
            $table->timestamp('time')->useCurrent();
            $table->enum('status', ['sudah', 'belum'])->default('sudah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suplemen_histories');
    }
};
