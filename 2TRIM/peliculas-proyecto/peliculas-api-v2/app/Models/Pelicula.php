<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $title
 * @property string $year
 * @property string $description
 * @property string $trailer
 * @property string $image
 */
class Pelicula extends Model
{
    

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
