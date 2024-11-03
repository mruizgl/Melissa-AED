<?php

namespace App\DAO;

use App\Contracts\ICrud;
use App\Contracts\FiguraContract;
use Illuminate\Support\Facades\DB;

class FiguraDAO implements ICrud
{
    public function findAll(): array
    {
        $pdo = DB::getPdo();
        $stmt = $pdo->query('SELECT * FROM ' . FiguraContract::TABLE_NAME);
        $figuras = [];

        while ($row = $stmt->fetch()) {
            $figuras[] = [
                FiguraContract::COL_ID => $row[FiguraContract::COL_ID],
                FiguraContract::COL_IMAGEN => $row[FiguraContract::COL_IMAGEN],
                FiguraContract::COL_TIPO_IMAGEN => $row[FiguraContract::COL_TIPO_IMAGEN],
            ];
        }

        return $figuras;
    }

    public function save($dao): bool 
    {
        $pdo = DB::getPdo();
        $stmt = $pdo->prepare('INSERT INTO ' . FiguraContract::TABLE_NAME . ' (' . FiguraContract::COL_IMAGEN . ', ' . FiguraContract::COL_TIPO_IMAGEN . ') VALUES (:imagen, :tipo_imagen)');
        return $stmt->execute([
            'imagen' => $dao[FiguraContract::COL_IMAGEN],
            'tipo_imagen' => $dao[FiguraContract::COL_TIPO_IMAGEN],
        ]);
    }

    public function findById($id): ?array
    {
        $pdo = DB::getPdo();
        $stmt = $pdo->prepare('SELECT * FROM ' . FiguraContract::TABLE_NAME . ' WHERE ' . FiguraContract::COL_ID . ' = :id');
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();

        if ($row) {
            return [
                FiguraContract::COL_ID => $row[FiguraContract::COL_ID],
                FiguraContract::COL_IMAGEN => $row[FiguraContract::COL_IMAGEN],
                FiguraContract::COL_TIPO_IMAGEN => $row[FiguraContract::COL_TIPO_IMAGEN],
            ];
        }

        return null; 
    }

    public function update($dao): bool
    {
        $pdo = DB::getPdo();
        $stmt = $pdo->prepare('UPDATE ' . FiguraContract::TABLE_NAME . ' SET ' . FiguraContract::COL_IMAGEN . ' = :imagen, ' . FiguraContract::COL_TIPO_IMAGEN . ' = :tipo_imagen WHERE ' . FiguraContract::COL_ID . ' = :id');
        return $stmt->execute([
            'imagen' => $dao[FiguraContract::COL_IMAGEN],
            'tipo_imagen' => $dao[FiguraContract::COL_TIPO_IMAGEN],
            'id' => $dao[FiguraContract::COL_ID],
        ]);
    }

    public function delete($id): bool
    {
        $pdo = DB::getPdo();
        $stmt = $pdo->prepare('DELETE FROM ' . FiguraContract::TABLE_NAME . ' WHERE ' . FiguraContract::COL_ID . ' = :id');
        return $stmt->execute(['id' => $id]);
    }
}
