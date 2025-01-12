<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelicula extends Model
{

    protected $table = 'peliculas';

    protected $fillable = ['titulo', 'year', 'descripcion', 'trailer', 'caratula', 'created_at', 'updated_at'];

    public function actoresPeliculas()
    {
        return $this->belongsToMany('App\Models\Actor', 'actores_peliculas', 'pelicula_id', 'actor_id');
    }

    public function directoresPeliculas()
    {
        return $this->belongsToMany('App\Models\Director','directores_peliculas', 'pelicula_id', 'director_id');
    }

}
