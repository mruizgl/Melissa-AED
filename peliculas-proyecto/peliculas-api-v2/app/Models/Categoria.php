<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 */
class Categoria extends Model
{

    protected $fillable = ['nombre'];

    public function peliculas() {
        return $this->belongsToMany(Pelicula::class);
    }
}

