<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maestro extends Model
{
    
    protected $table = 'maestros';
    protected $primaryKey = 'id_maestro';
    public $incrementing = true;  // Sí autoincrementa en migración
    protected $keyType = 'int';   // Por defecto int para bigIncrements

    public $timestamps = true;    // Por defecto true, está bien

    protected $fillable = [
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
