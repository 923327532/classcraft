<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Estudiante;
use App\Models\Nivel;
use App\Models\User;

class EstudianteSeeder extends Seeder
{
    public function run(): void
    {
        $nivel1 = Nivel::where('numero_nivel', 1)->first();

        if (!$nivel1) {
            $this->command->info('¡Asegúrate de ejecutar NivelSeeder primero para crear los niveles!');
            return;
        }

        $user = User::firstOrCreate(
            ['email' => 'test@example.com'],
            ['name' => 'Test User', 'password' => bcrypt('password')]
        );

        Estudiante::firstOrCreate(
            ['user_id' => $user->id],
            [
                'nombre' => 'Estudiante de Prueba',
                'xp_actual' => 0,
                'nivel_id' => $nivel1->id,
                'poder_seleccionado_id' => null,
                'clase_personaje' => 'Guerrero',
                'puntos_experiencia' => 0,
                'puntos_vida' => 100,
                'puntos_accion' => 50,
                'puntos_cristal' => 0,
                'puntos_oro' => 0,
            ]
        );
    }
}
