<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEkskulPembimbingTable extends Migration
{
    public function up()
    {
        Schema::create('ekskul_pembimbing', function (Blueprint $table) {
            $table->foreignId('ekskul_id')->constrained('ekskul')->onDelete('cascade');
            $table->foreignId('pembimbing_id')->constrained('users')->onDelete('cascade');
            $table->primary(['ekskul_id', 'pembimbing_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('ekskul_pembimbing');
    }
}

