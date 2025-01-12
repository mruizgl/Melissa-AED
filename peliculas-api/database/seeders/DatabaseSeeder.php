<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\ActorSeeder;
use Database\Seeders\CategoriaSeeder;
use Database\Seeders\DirectorSeeder;
use Database\Seeders\PeliculaSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {        

        $this->call([
            ActorSeeder::class,
            CategoriaSeeder::class,
            DirectorSeeder::class,
            PeliculaSeeder::class,
        ]);
    }
}
