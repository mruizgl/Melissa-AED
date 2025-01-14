<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriaSeeder extends Seeder
{
    public function run()
    {
        $categorias = [
            'Acción',
            'Drama',
            'Ciencia Ficción',
            'Comedia',
            'Aventura',
        ];

        foreach ($categorias as $nombre) {
            Categoria::create(['nombre' => $nombre]);
        }
    }
}
