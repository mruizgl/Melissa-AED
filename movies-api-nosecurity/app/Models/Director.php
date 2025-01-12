<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Director extends Model
{
    public $timestamps = false;

    protected $hidden = ['pivot'];
 
    protected $table = 'directores';

    protected $fillable = ['nombre', 'apellidos'];

    public function directoresPeliculas()
    {
        return $this->belongsToMany('App\Models\Pelicula', 'directores_peliculas', 'director_id', 'pelicula_id');
    }
}
