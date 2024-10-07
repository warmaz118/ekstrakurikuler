<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswaTable extends Migration
{
    public function up()
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // user_id sebagai foreign key
            $table->string('nis')->unique();
            $table->string('kelas');
            $table->string('alamat');
            $table->unsignedBigInteger('divisi_id');
            $table->timestamps();
        
            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('divisi_id')->references('id')->on('divisi')->onDelete('cascade');
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('siswa');
    }
}

