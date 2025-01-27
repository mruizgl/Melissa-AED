<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Moneda;

class MonedaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Insertar algunas monedas de ejemplo
        Moneda::create([
            'pais' => 'Estados Unidos',
            'nombre' => 'Dólar',
        ]);

        Moneda::create([
            'pais' => 'Eurozona',
            'nombre' => 'Euro',
        ]);

        Moneda::create([
            'pais' => 'Reino Unido',
            'nombre' => 'Libra Esterlina',
        ]);

        Moneda::create([
            'pais' => 'Japón',
            'nombre' => 'Yen',
        ]);

        Moneda::create([
            'pais' => 'Suiza',
            'nombre' => 'Franco Suizo',
        ]);

        Moneda::create([
            'pais' => 'Canadá',
            'nombre' => 'Dólar Canadiense',
        ]);
    }
}
