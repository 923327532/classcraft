<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clase extends Model
{
    use HasFactory;

     protected $primaryKey = 'id_clase';
    public $incrementing = true;  // Cambiar a true porque en migración usas $table->id('id_clase') que es autoincrement
    protected $keyType = 'int';   // Cambiar a int porque es BIGINT autoincrement en BD
    

    protected $fillable = [
        'id_clase',
        'nombre_clase',
        'nivel',
        'id_maestro',
        'fecha_inicio',
        'fecha_fin',
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
    ];

    public function maestro()
    {
        return $this->belongsTo(Maestro::class, 'id_maestro', 'id_maestro');
    }

    public function estudiantes()
    {
        return $this->hasMany(Estudiante::class, 'id_clase', 'id_clase');
    }
}
