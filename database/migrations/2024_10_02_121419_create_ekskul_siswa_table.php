<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEkskulSiswaTable extends Migration
{
    public function up()
    {
        Schema::create('ekskul_siswa', function (Blueprint $table) {
            $table->foreignId('ekskul_id')->constrained('ekskul')->onDelete('cascade');
            $table->foreignId('siswa_id')->constrained('siswa')->onDelete('cascade');
            $table->primary(['ekskul_id', 'siswa_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('ekskul_siswa');
    }
}
