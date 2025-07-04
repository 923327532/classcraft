<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->call([
            NivelSeeder::class,
            PoderSeeder::class,
            \Database\Seeders\AccesoriosTableSeeder::class, 
        ]);
    }
}