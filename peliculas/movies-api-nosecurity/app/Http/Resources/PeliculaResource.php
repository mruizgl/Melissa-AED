<?php

namespace App\Http\Resources;

use App\Models\Pelicula;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ActorResource;

class PeliculaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $movie = Pelicula::find($this->id);

    $actors = $movie->actoresPeliculas; // Accede a actores
    $categories = $movie->categoriasPeliculas; // Accede a categorías
    $directors = $movie->directoresPeliculas; // Accede a directores

    return [
        'id' => $this->id,
        'titulo' => $this->titulo,
        'year' => $this->year,
        'descripcion' => $this->descripcion,
        'caratula' => $this->caratula,
        'trailer' => $this->trailer,
        'actores' => ActorResource::collection($actors), // Recurso de actores
        'categorias' => CategoriaResource::collection($categories), // Recurso de categorías
        'directores' => DirectorResource::collection($directors), // Recurso de directores
    ];
    }
}
