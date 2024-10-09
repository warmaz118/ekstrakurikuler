<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEkskulTable extends Migration
{
    public function up()
    {
        Schema::create('ekskul', function (Blueprint $table) {
            $table->id();
            $table->foreignId('divisi_id')->constrained('divisi')->onDelete('cascade');
            $table->string('name')->unique();
            $table->string('lokasi');
            $table->text('deskripsi');
            $table->unsignedInteger('kapasitas')->default(0); // Kapasitas maksimal peserta ekskul
            $table->unsignedInteger('jumlah_peserta')->default(0); // Jumlah peserta yang terdaftar
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ekskul');
    }
}

