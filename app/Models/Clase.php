<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clase extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_clase';
    public $incrementing = false;
    protected $keyType = 'string';
    

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
