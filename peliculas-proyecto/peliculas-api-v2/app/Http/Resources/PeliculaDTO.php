<?php

namespace App\Http\Resources;

use App\Models\Pelicula;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PeliculaDTO extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // No es necesario hacer un find adicional si la instancia de Pelicula ya está disponible.
        // Asumiendo que la clase Pelicula tiene los datos necesarios ya cargados.

        return [
            'id' => $this->id,
            'argumento' => $this->argumento,  // campo argumento de la base de datos
            'imagen' => $this->imagen,        // campo imagen de la base de datos
            'created_at' => $this->created_at, // Si necesitas mostrar la fecha de creación
            'updated_at' => $this->updated_at  // Si necesitas mostrar la fecha de actualización
        ];
    }
}
