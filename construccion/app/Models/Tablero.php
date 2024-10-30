<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tablero extends Model
{
    private $id;
    private $usuario_id;
    private $nombre;
    private $contenido;
    private $fecha;

    public function getId()
    {
        return $this->id;
    }

    public function getUsuarioId()
    {
        return $this->usuario_id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getContenido()
    {
        return $this->contenido;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    // Setters
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setUsuarioId($usuario_id)
    {
        $this->usuario_id = $usuario_id;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function setContenido($contenido)
    {
        $this->contenido = $contenido;
    }

    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }
}
