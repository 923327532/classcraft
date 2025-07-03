<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Estudiante extends Model
{
     use HasFactory;

    protected $primaryKey = 'id_estudiante';  // Big increments en migración

    protected $fillable = [
        'user_id',
        'id_clase',
        'id_accesorio', 
        'nivel_id',
        'clase_personaje',
        'puntos_experiencia',
        'puntos_vida',
        'puntos_accion',
        'puntos_oro',
        'selected_background_path',
        'poder_seleccionado_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function nivel()
    {
        return $this->belongsTo(Nivel::class, 'nivel_id');
    }

    public function poderSeleccionado()
    {
        return $this->belongsTo(Poder::class, 'poder_seleccionado_id');
    }

    public function accesorio()
    {
        return $this->belongsTo(Accesorio::class, 'id_accesorio');
    }

    public function getCombinedImagePathAttribute()
    {
        $clasePersonaje = $this->clase_personaje;
        $backgroundPath = $this->selected_background_path;

        if (!$clasePersonaje || !$backgroundPath) {
            return 'images/default_combined_image.png';
        }

        $backgroundPath = str_replace('images/fondo/', '', $backgroundPath);
        $backgroundPath = str_replace('images\\fondo\\', '', $backgroundPath);

        $finalPath = 'images/fondo/' . $clasePersonaje . '/' . $backgroundPath;

        return $finalPath;
    }
}