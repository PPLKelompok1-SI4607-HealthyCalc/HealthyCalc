<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePantangansTable extends Migration
{
    public function up()
    {
        Schema::create('pantangans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_makanan');
            $table->string('kategori'); // Alergi, Kesehatan, Diet
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pantangans');
    }
};