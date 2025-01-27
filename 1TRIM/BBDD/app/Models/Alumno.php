<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $created_at
 * @property string $updated_at
 * @property string $nombre
 * @property string $apellidos
 * @property integer $edad
 */
class Alumno extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['created_at', 'updated_at', 'nombre', 'apellidos', 'edad'];
}
