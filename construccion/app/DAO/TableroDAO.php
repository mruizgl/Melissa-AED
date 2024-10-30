
<?php

namespace App\DAO;

use App\Models\Tablero;
use App\Contracts\ICrud;
use Illuminate\Support\Facades\DB;
use App\Contracts\TableroContract;

class TableroDAO implements ICrud
{
    public function findAll(): array
    {
        $pdo = DB::getPdo();
        $stmt = $pdo->query('SELECT * FROM ' . TableroContract::TABLE_NAME);
        $tableros = [];

        while ($row = $stmt->fetch()) {
            $tablero = new Tablero();
            $tablero->setId($row[TableroContract::COL_ID]);
            $tablero->setUsuarioId($row[TableroContract::COL_USUARIO_ID]);
            $tablero->setNombre($row[TableroContract::COL_NOMBRE]);
            $tablero->setContenido($row[TableroContract::COL_CONTENIDO]);
            $tablero->setFecha($row[TableroContract::COL_FECHA]);
            $tableros[] = $tablero;
        }

        return $tableros;
    }

    public function save($tablero): bool
    {
        $pdo = DB::getPdo();
        $pdo->beginTransaction();
        try {
            $stmt = $pdo->prepare('INSERT INTO ' . TableroContract::TABLE_NAME . ' (usuario_id, nombre, contenido, fecha) VALUES (:usuario_id, :nombre, :contenido, :fecha)');

            $fecha = time();
            $stmt->bindParam(':usuario_id', $tablero->getUsuarioId());
            $stmt->bindParam(':nombre', $tablero->getNombre());
            $stmt->bindParam(':contenido', $tablero->getContenido());
            $stmt->bindParam(':fecha', $fecha);

            if ($stmt->execute()) {
                $pdo->commit();
                return true;
            } else {
                $pdo->rollBack();
                return false;
            }
        } catch (\Exception $e) {
            $pdo->rollBack();
            throw $e;
        }
    }

    public function update($tablero): bool
    {
        $pdo = DB::getPdo();
        $pdo->beginTransaction();
        try {
            $stmt = $pdo->prepare('UPDATE ' . TableroContract::TABLE_NAME . ' SET nombre = :nombre, contenido = :contenido, fecha = :fecha WHERE id = :id');

            $fecha = time();
            $stmt->bindParam(':id', $tablero->getId());
            $stmt->bindParam(':nombre', $tablero->getNombre());
            $stmt->bindParam(':contenido', $tablero->getContenido());
            $stmt->bindParam(':fecha', $fecha);

            if ($stmt->execute()) {
                $pdo->commit();
                return true;
            } else {
                $pdo->rollBack();
                return false;
            }
        } catch (\Exception $e) {
            $pdo->rollBack();
            throw $e;
        }
    }

    public function delete($id): bool
    {
        $pdo = DB::getPdo();
        $pdo->beginTransaction();
        try {
            $stmt = $pdo->prepare('DELETE FROM ' . TableroContract::TABLE_NAME . ' WHERE id = :id');
            $stmt->bindParam(':id', $id);

            if ($stmt->execute()) {
                $pdo->commit();
                return true;
            } else {
                $pdo->rollBack();
                return false;
            }
        } catch (\Exception $e) {
            $pdo->rollBack();
            throw $e;
        }
    }



    public function findById($id): ?Tablero
    {
        $pdo = DB::getPdo();
        $stmt = $pdo->prepare('SELECT * FROM ' . TableroContract::TABLE_NAME . ' WHERE id = ?');
        $stmt->execute([$id]);

        if ($row = $stmt->fetch()) {
            $tablero = new Tablero();
            $tablero->setId($row[TableroContract::COL_ID]);
            $tablero->setUsuarioId($row[TableroContract::COL_USUARIO_ID]);
            $tablero->setNombre($row[TableroContract::COL_NOMBRE]);
            $tablero->setContenido($row[TableroContract::COL_CONTENIDO]);
            $tablero->setFecha($row[TableroContract::COL_FECHA]);

            return $tablero;
        }

        return null;
    }
}
