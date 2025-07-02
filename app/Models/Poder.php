<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poder extends Model
{
    use HasFactory;

    protected $table = 'poderes';
    protected $fillable = ['nivel_id', 'nombre_poder', 'descripcion', 'clase_personaje', 'ruta_imagen', 'costo_pp'];

    public function nivel()
    {
        return $this->belongsTo(Nivel::class, 'nivel_id', 'id');
    }
}
