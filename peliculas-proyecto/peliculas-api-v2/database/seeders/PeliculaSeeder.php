<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pelicula;
use App\Models\Categoria;
use App\Models\Director;
use App\Models\Actor;

class PeliculaSeeder extends Seeder
{
    public function run()
    {
        $peliculas = [
            [
                'titulo' => 'Todo a la vez en todas partes',
                'argumento' => 'Cuando una ruptura interdimensional altera la realidad...',
                'imagen' => '001.jpg',
                'directores' => ['Dan Kwan', 'Daniel Scheinert', 'Daniels'],
                'actores' => ['Michelle Yeoh', 'Ke Huy Quan', 'Jamie Lee Curtis'],
                'categorias' => ['Acción', 'Ciencia Ficción'],
            ],
            [
                'titulo' => 'Ellas hablan',
                'argumento' => 'En 2010, las mujeres que integran una colonia religiosa...',
                'imagen' => '002.jpg',
                'directores' => ['Sarah Polley'],
                'actores' => ['Rooney Mara', 'Claire Foy', 'Ben Whishaw', 'Jessie Buckley'],
                'categorias' => ['Drama'],
            ],
            [
                'titulo' => 'El triángulo de la tristeza',
                'argumento' => 'Tras la Semana de la moda, Carl y Yaya...',
                'imagen' => '003.jpg',
                'directores' => ['Ruben Östlund'],
                'actores' => ['Harris Dickinson', 'Charlbi Dean', 'Zlatko Buric', 'Dolly De Leon'],
                'categorias' => ['Comedia', 'Drama'],
            ],
            [
                'titulo' => 'Top Gun: Maverick',
                'argumento' => 'Después de más de treinta años de servicio...',
                'imagen' => '004.jpg',
                'directores' => ['Joseph Kosinski'],
                'actores' => ['Tom Cruise', 'Miles Teller', 'Jennifer Connelly', 'Jon Hamm'],
                'categorias' => ['Acción', 'Aventura'],
            ],
        ];

        foreach ($peliculas as $data) {
            $pelicula = Pelicula::create([
                'titulo' => $data['titulo'],
                'argumento' => $data['argumento'],
                'imagen' => $data['imagen'],
            ]);

            // Asociar directores
            foreach ($data['directores'] as $nombreDirector) {
                $director = Director::firstWhere('nombre', $nombreDirector);
                $pelicula->directors()->attach($director);
            }

            // Asociar actores
            foreach ($data['actores'] as $nombreActor) {
                $actor = Actor::firstWhere('nombre', $nombreActor);
                $pelicula->actors()->attach($actor);
            }

            // Asociar categorías
            foreach ($data['categorias'] as $nombreCategoria) {
                $categoria = Categoria::firstWhere('nombre', $nombreCategoria);
                $pelicula->categorias()->attach($categoria);
            }
        }
    }
    
}
