<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'provider',      
        'provider_id',   
        'avatar',        
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function estudiante()
    {
        return $this->hasOne(Estudiante::class, 'user_id', 'id');
    }

    public function maestro()
    {
        return $this->hasOne(Maestro::class, 'user_id', 'id');
    }

    public function esEstudiante()
{
    return $this->role === 'estudiante'; // o como se llame tu campo de rol
}

public function esMaestro()
{
    return $this->role === 'profesor'; // asegúrate que esos roles existan en tu base de datos
}

}