<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Figura extends Model
{
    private $id;
    private $imagen;
    private $tipo_imagen;
    
    // Getter y Setter para $id
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    // Getter y Setter para $imagen
    public function getImagen()
    {
        return $this->imagen;
    }

    public function setImagen($imagen)
    {
        $this->imagen = $imagen;
    }

    // Getter y Setter para $tipo_imagen
    public function getTipoImagen()
    {
        return $this->tipo_imagen;
    }

    public function setTipoImagen($tipo_imagen)
    {
        $this->tipo_imagen = $tipo_imagen;
    }

}
