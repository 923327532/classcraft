<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->bigIncrements('id_estudiante')->primary();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('id_clase')->nullable();
            $table->string('id_accesorio')->nullable();

            $table->foreignId('nivel_id')->default(1)->constrained('niveles')->onDelete('cascade');
            
            $table->string('clase_personaje')->nullable();
            $table->integer('puntos_experiencia')->default(0);
            $table->integer('puntos_vida')->default(0);
            $table->integer('puntos_accion')->default(0);
            $table->integer('puntos_oro')->default(0);

            $table->foreignId('poder_seleccionado_id')->nullable()->constrained('poderes')->onDelete('set null');
            
            $table->string('selected_background_path')->nullable();

            $table->timestamps();

            $table->foreign('id_clase')->references('id_clase')->on('clases')->onDelete('cascade');
            $table->foreign('id_accesorio')->references('id_accesorio')->on('accesorios')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('estudiantes');
    }
};