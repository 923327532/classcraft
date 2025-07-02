<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClasesTable extends Migration
{
    public function up()
    {
        Schema::create('clases', function (Blueprint $table) {
            $table->string('id_clase')->primary();
            $table->string('nombre_clase');
            $table->integer('nivel')->default(1);
            $table->unsignedBigInteger('id_maestro');
            $table->date('fecha_inicio')->nullable(); 
            $table->date('fecha_fin')->nullable();   
            $table->timestamps();

            $table->foreign('id_maestro')->references('id_maestro')->on('maestros')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('clases');
    }
}