<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nivel extends Model
{
    use HasFactory;

    protected $table = 'niveles';
    protected $fillable = ['numero_nivel', 'xp_requerida'];

    public function poderes()
    {
        return $this->hasMany(Poder::class, 'nivel_id', 'id');
    }
}
