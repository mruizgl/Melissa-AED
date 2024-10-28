<?php

namespace App\DAO;

use App\Models\Rol;
use App\Contracts\ICrud;
use Illuminate\Support\Facades\DB;
use App\Contracts\RolContract;

class RolDAO implements ICrud
{
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

    public function save($rol): bool
    {
        $pdo = DB::getPdo();
        $stmt = $pdo->prepare('INSERT INTO ' . RolContract::TABLE_NAME . ' (' . RolContract::COL_NOMBRE . ') VALUES (:nombre)');
        return $stmt->execute(['nombre' => $rol->getNombre()]);
    }

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

    public function update($rol): bool
    {
        $pdo = DB::getPdo();
        $stmt = $pdo->prepare('UPDATE ' . RolContract::TABLE_NAME . ' SET ' . RolContract::COL_NOMBRE . ' = :nombre WHERE ' . RolContract::COL_ID . ' = :id');
        return $stmt->execute([
            'nombre' => $rol->getNombre(),
            'id' => $rol->getId()
        ]);
    }

    public function delete($id): bool
    {
        $pdo = DB::getPdo();
        $stmt = $pdo->prepare('DELETE FROM ' . RolContract::TABLE_NAME . ' WHERE ' . RolContract::COL_ID . ' = :id');
        return $stmt->execute(['id' => $id]);
    }
}


