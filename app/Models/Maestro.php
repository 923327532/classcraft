<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maestro extends Model
{
    protected $table = 'maestros';

    protected $primaryKey = 'id_maestro'; 
    public $incrementing = true; 
    public $timestamps = true; 

    protected $fillable = [
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
