<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Importar DB
use Illuminate\Support\Str; // Importar Str

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       // Generar 10 productos de ejemplo
       for ($i = 0; $i < 10; $i++) {
        DB::table('productos')->insert([
            'nombre' => 'Producto ' . Str::random(5),
            'precio' => rand(10, 500), // Precio entre 10 y 500
            'cantidad' => rand(1, 100), // Cantidad entre 1 y 100
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        }
    }
}
