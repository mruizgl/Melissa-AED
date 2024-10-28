<?php

namespace App\DAO;

use App\Models\Usuario;
use App\Contracts\ICrud;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Contracts\UsuarioContract;

class UsuarioDAO implements ICrud
{
    public function findAll(): array
    {
        $pdo = DB::getPdo();
        $stmt = $pdo->query('SELECT * FROM ' . UsuarioContract::TABLE_NAME);
        $usuarios = [];

        while ($row = $stmt->fetch()) {
            $usuario = new Usuario();
            $usuario->setId($row[UsuarioContract::COL_ID]);
            $usuario->setNombre($row[UsuarioContract::COL_NOMBRE]);
            $usuario->setPassword($row[UsuarioContract::COL_PASSWORD]);
            $usuario->setRolId($row[UsuarioContract::COL_ROL_ID]);
            $usuarios[] = $usuario;
        }

        return $usuarios;
    }

    public function save($usuario): bool
    {
        $pdo = DB::getPdo();
        //dd($pdo, $usuario);
        $stmt = $pdo->prepare('INSERT INTO ' . UsuarioContract::TABLE_NAME . ' (' . UsuarioContract::COL_NOMBRE . ', ' . UsuarioContract::COL_PASSWORD . ', ' . UsuarioContract::COL_ROL_ID . ') 
        VALUES (:nombre, :password, :rol)');
        return $stmt->execute([
            'nombre' => $usuario->getNombre(),
            'password' => Hash::make($usuario->getPassword()),
            'rol' => $usuario->getRolId()
        ]);
    }     

    public function findById($id): ?Usuario
    {
        $pdo = DB::getPdo();
        $stmt = $pdo->prepare('SELECT * FROM ' . UsuarioContract::TABLE_NAME . ' WHERE ' . UsuarioContract::COL_ID . ' = :id');
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();

        if ($row) {
            $usuario = new Usuario();
            $usuario->setId($row[UsuarioContract::COL_ID]);
            $usuario->setNombre($row[UsuarioContract::COL_NOMBRE]);
            $usuario->setPassword($row[UsuarioContract::COL_PASSWORD]);
            $usuario->setRolId($row[UsuarioContract::COL_ROL_ID]);
            return $usuario;
        }

        return null;
    }

    public function update($usuario): bool
    {
        $pdo = DB::getPdo();
        $stmt = $pdo->prepare('UPDATE ' . UsuarioContract::TABLE_NAME . ' SET ' . UsuarioContract::COL_NOMBRE . ' = :nombre, ' . UsuarioContract::COL_PASSWORD . ' = :password, ' . UsuarioContract::COL_ROL_ID . ' = :rol_id WHERE ' . UsuarioContract::COL_ID . ' = :id');
        return $stmt->execute([
            'nombre' => $usuario->getNombre(),
            'password' => Hash::make($usuario->getPassword()),
            'rol_id' => $usuario->getRolId(),
            'id' => $usuario->getId()
        ]);
    }

    public function delete($id): bool
    {
        $pdo = DB::getPdo();
        $stmt = $pdo->prepare('DELETE FROM ' . UsuarioContract::TABLE_NAME . ' WHERE ' . UsuarioContract::COL_ID . ' = :id');
        return $stmt->execute(['id' => $id]);
    }

    public function findByName(string $nombre): ?Usuario
    {
        $pdo = DB::getPdo();
        $stmt = $pdo->prepare('SELECT * FROM ' . UsuarioContract::TABLE_NAME . ' WHERE ' . UsuarioContract::COL_NOMBRE . ' = :nombre');
        $stmt->execute(['nombre' => $nombre]);
        $row = $stmt->fetch();

        if ($row) {
            $usuario = new Usuario();
            $usuario->setId($row[UsuarioContract::COL_ID]);
            $usuario->setNombre($row[UsuarioContract::COL_NOMBRE]);
            $usuario->setPassword($row[UsuarioContract::COL_PASSWORD]);
            $usuario->setRolId($row[UsuarioContract::COL_ROL_ID]);
            return $usuario;
        }

        return null;
    }
}
