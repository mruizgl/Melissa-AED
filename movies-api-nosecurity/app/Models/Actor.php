<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    
    public $timestamps = false;


    protected $hidden = ['pivot'];

   
    protected $table = 'actores';

   
    protected $fillable = ['nombre', 'apellidos'];

    
    public function actoresPeliculas()
    {
        return $this->belongsToMany('App\Models\Pelicula', 'actores_peliculas', 'actor_id', 'pelicula_id');
    }
}
