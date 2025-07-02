<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('poderes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nivel_id')->constrained('niveles')->onDelete('cascade');
            $table->string('nombre_poder');
            $table->text('descripcion');
            $table->string('clase_personaje')->nullable();
            $table->string('ruta_imagen');
            $table->integer('costo_pp');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('poderes');
    }
};
