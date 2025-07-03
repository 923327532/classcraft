<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->bigIncrements('id_estudiante');

            // Relaciones
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->unsignedBigInteger('id_clase')->nullable();
            $table->string('id_accesorio')->nullable();

            // Nivel con FK manual porque tiene default
            $table->unsignedBigInteger('nivel_id')->default(1);
            $table->foreign('nivel_id')->references('id')->on('niveles')->onDelete('cascade');

            $table->foreignId('poder_seleccionado_id')->nullable()->constrained('poderes')->onDelete('set null');

            // Datos del personaje
            $table->string('clase_personaje')->nullable();
            $table->integer('puntos_experiencia')->default(0);
            $table->integer('puntos_vida')->default(0);
            $table->integer('puntos_accion')->default(0);
            $table->integer('puntos_oro')->default(0);
            $table->string('selected_background_path')->nullable();

            $table->timestamps();

            // Foreign keys manuales
            $table->foreign('id_clase')->references('id_clase')->on('clases')->onDelete('cascade');
            // Comentamos FK de id_accesorio para evitar problemas de tipo
            // $table->foreign('id_accesorio')->references('id_accesorio')->on('accesorios')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('estudiantes');
    }
};
