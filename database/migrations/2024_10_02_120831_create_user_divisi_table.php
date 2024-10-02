<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDivisiTable extends Migration
{
    public function up()
    {
        Schema::create('user_divisi', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('divisi_id')->constrained('divisi')->onDelete('cascade');
            $table->primary(['user_id', 'divisi_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_divisi');
    }
}
