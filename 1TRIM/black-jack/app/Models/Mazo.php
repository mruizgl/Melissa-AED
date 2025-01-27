<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;

class Mazo //extends Model
{
    private $cartas;

    public function __construct($cartas) {
        $this->cartas = $this->crearMazo();
    }
}
