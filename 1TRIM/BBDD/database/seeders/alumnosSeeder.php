<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\Alumnos::factory(10)->create();

        \App\Models\Alumnos::factory()->create([
             'name' => 'Test User',
             'apellidos' => 'test@example.com',
             'edad' => 5,
         ]);
    }
}
