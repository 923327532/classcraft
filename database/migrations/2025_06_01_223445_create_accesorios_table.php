<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccesoriosTable extends Migration
{
    public function up()
    {
        Schema::create('accesorios', function (Blueprint $table) {
            $table->string('id_accesorio')->primary();
            $table->string('nombre_accesorio');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('accesorios');
    }
}