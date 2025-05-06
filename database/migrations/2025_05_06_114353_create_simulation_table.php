<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('simulasi_defisit', function (Blueprint $table) {
            $table->id();
            $table->float('target_berat');
            $table->integer('durasi');
            $table->string('tingkat_aktivitas');
            $table->float('kebutuhan_kalori');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('simulasi_defisit');
    }
};