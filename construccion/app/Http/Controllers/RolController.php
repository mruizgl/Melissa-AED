<?php

use App\DAO\RolDAO;
use App\Models\Rol;

class RolController extends Controller
{
    protected $rolDAO;

    public function __construct()
    {
        $this->rolDAO = new RolDAO();
    }

    public function mostrarRol($id)
    {
        $rol = $this->rolDAO->findById($id);
        if ($rol) {
            echo "ID: " . $rol->getId() . ", Nombre: " . $rol->getNombre();
        } else {
            echo "Rol no encontrado.";
        }
    }

    public function crearRol($nombre)
    {
        $rol = new Rol();
        $rol->setNombre($nombre);

        if ($this->rolDAO->save($rol)) {
            echo "Rol creado exitosamente.";
        } else {
            echo "Error al crear el rol.";
        }
    }
}

