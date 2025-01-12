<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Actor;
use App\Models\Director;
use App\Models\Categoria;

class Pelicula extends Model
{
    /** @use HasFactory<\Database\Factories\PeliculaFactory> */
    use HasFactory;

    protected $fillable = ['argumento', 'imagen'];

    public function actors() {
        return $this->belongsToMany(Actor::class);
    }

    public function directors() {
        return $this->belongsToMany(Director::class);
    }

    public function categorias () {
        return $this->belongsToMany(Categoria::class);
    }
}
