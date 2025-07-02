<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Nivel;

class NivelSeeder extends Seeder
{
    public function run(): void
    {
        Nivel::firstOrCreate(['numero_nivel' => 1], ['xp_requerida' => 0]);
        Nivel::firstOrCreate(['numero_nivel' => 2], ['xp_requerida' => 100]);
        Nivel::firstOrCreate(['numero_nivel' => 3], ['xp_requerida' => 250]);
    }
}