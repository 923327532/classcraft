<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccesoriosTableSeeder extends Seeder
{
    public function run(): void
    {
        $accesorios = [
            [
                'id_accesorio' => 'acc_001',
                'nombre_accesorio' => 'Aro Puro',
                'imagen' => 'images/accesorios/aropuro.png',
                'descripcion' => 'Aumenta tu poder mágico en un 10%.',
            ],
            [
                'id_accesorio' => 'acc_002',
                'nombre_accesorio' => 'Bota Andante',
                'imagen' => 'images/accesorios/botaandante.png',
                'descripcion' => 'Mejora tu velocidad y evasión en un 5%.',
            ],
            [
                'id_accesorio' => 'acc_003',
                'nombre_accesorio' => 'Broche',
                'imagen' => 'images/accesorios/broche.png',
                'descripcion' => 'Otorga resistencia a hechizos elementales.',
            ],
            [
                'id_accesorio' => 'acc_004',
                'nombre_accesorio' => 'Caliz Vital',
                'imagen' => 'images/accesorios/calizvital.png',
                'descripcion' => 'Incrementa tu velocidad de movimiento en un 15%.',
            ],
            [
                'id_accesorio' => 'acc_005',
                'nombre_accesorio' => 'Velo Bendito',
                'imagen' => 'images/accesorios/velobendito.png',
                'descripcion' => 'Reduce el daño físico recibido en un 8%.',
            ],
        ];

        foreach ($accesorios as $accesorio) {
            DB::table('accesorios')->insertOrIgnore([
                'id_accesorio' => $accesorio['id_accesorio'],
                'nombre_accesorio' => $accesorio['nombre_accesorio'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}