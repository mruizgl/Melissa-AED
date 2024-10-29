<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    protected string $nombre;
    protected string $apellidos;
    protected int $edad;

    use HasFactory;
}
