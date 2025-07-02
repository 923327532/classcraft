<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    protected $table = 'alumnos';
    protected $primaryKey = 'matricula';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = ['nombre', 'correo', 'grupo'];

    public function proyectos()
    {
        return $this->belongsToMany(Proyecto::class, 'alumno_proyecto', 'matricula', 'id_proyecto');
    }
}
