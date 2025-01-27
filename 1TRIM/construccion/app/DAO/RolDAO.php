<?php

namespace App\DAO;

use App\Models\Rol;
use App\Contracts\ICrud;
use Illuminate\Support\Facades\DB;
use App\Contracts\RolContract;

/**
 * @author Melissa Ruiz
 * Clase DAO de Rol
 */
class RolDAO implements ICrud
{
    /**
     * Obtener todos los datos
     */
    public function findAll(): array
    {
        $pdo = DB::getPdo();
        $stmt = $pdo->query('SELECT * FROM ' . RolContract::TABLE_NAME);
        $roles = [];

        while ($row = $stmt->fetch()) {
            $rol = new Rol();
            $rol->setId($row[RolContract::COL_ID]);
            $rol->setNombre($row[RolContract::COL_NOMBRE]);
            $roles[] = $rol;
        }

        return $roles;
    }

    /**
     * Guardar rol
     */
    public function save($rol): bool
    {
        $pdo = DB::getPdo();
        $stmt = $pdo->prepare('INSERT INTO ' . RolContract::TABLE_NAME . ' (' . RolContract::COL_NOMBRE . ') VALUES (:nombre)');
        return $stmt->execute(['nombre' => $rol->getNombre()]);
    }

    /**
     * Obtener por id
     * @param id de Rol
     */
    public function findById($id): ?Rol
    {
        $pdo = DB::getPdo();
        $stmt = $pdo->prepare('SELECT * FROM ' . RolContract::TABLE_NAME . ' WHERE ' . RolContract::COL_ID . ' = :id');
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();

        if ($row) {
            $rol = new Rol();
            $rol->setId($row[RolContract::COL_ID]);
            $rol->setNombre($row[RolContract::COL_NOMBRE]);
            return $rol;
        }

        return null;
    }

    
     /**
     * Actualizar rol
     * @param id de Rol
     */
    public function update($rol): bool
    {
        $pdo = DB::getPdo();
        $stmt = $pdo->prepare('UPDATE ' . RolContract::TABLE_NAME . ' SET ' . RolContract::COL_NOMBRE . ' = :nombre WHERE ' . RolContract::COL_ID . ' = :id');
        return $stmt->execute([
            'nombre' => $rol->getNombre(),
            'id' => $rol->getId()
        ]);
    }

    /**
     * Funcion para eliminar por id el Rol
     * @param id del Rol
     */
    public function delete($id): bool
    {
        $pdo = DB::getPdo();
        $stmt = $pdo->prepare('DELETE FROM ' . RolContract::TABLE_NAME . ' WHERE ' . RolContract::COL_ID . ' = :id');
        return $stmt->execute(['id' => $id]);
    }
}


