<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaestrosTable extends Migration
{
    public function up()
    {
        Schema::create('maestros', function (Blueprint $table) {
            $table->bigIncrements('id_maestro');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('maestros');
    }
}
