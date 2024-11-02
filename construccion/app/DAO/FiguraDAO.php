<?php

use App\Contracts\ICrud;

class FiguraDAO implements ICrud
{
    private $pdo;

    // Constructor que recibe una instancia de PDO
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Implementación del método findAll para obtener todas las figuras
    public function findAll()
    {
        $sql = "SELECT * FROM " . FiguraContract::TABLE_NAME;
        $stmt = $this->pdo->query($sql);
        $figuras = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $figuras[] = [
                FiguraContract::COL_ID => $row[FiguraContract::COL_ID],
                FiguraContract::COL_IMAGEN => $row[FiguraContract::COL_IMAGEN],
                FiguraContract::COL_TIPO_IMAGEN => $row[FiguraContract::COL_TIPO_IMAGEN]
            ];
        }

        return $figuras;
    }

    // Implementación del método save para crear una nueva figura
    public function save($dao)
    {
        $sql = "INSERT INTO " . FiguraContract::TABLE_NAME . " (" . FiguraContract::COL_IMAGEN . ", " . FiguraContract::COL_TIPO_IMAGEN . ") VALUES (:imagen, :tipo_imagen)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':imagen', $dao[FiguraContract::COL_IMAGEN], PDO::PARAM_LOB);
        $stmt->bindParam(':tipo_imagen', $dao[FiguraContract::COL_TIPO_IMAGEN], PDO::PARAM_STR);
        return $stmt->execute();
    }

    // Implementación del método findById para obtener una figura por su ID
    public function findById($id)
    {
        $sql = "SELECT * FROM " . FiguraContract::TABLE_NAME . " WHERE " . FiguraContract::COL_ID . " = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return [
                FiguraContract::COL_ID => $row[FiguraContract::COL_ID],
                FiguraContract::COL_IMAGEN => $row[FiguraContract::COL_IMAGEN],
                FiguraContract::COL_TIPO_IMAGEN => $row[FiguraContract::COL_TIPO_IMAGEN]
            ];
        }

        return null; // Retorna null si no se encuentra la figura
    }

    // Implementación del método update para actualizar una figura
    public function update($dao)
    {
        $sql = "UPDATE " . FiguraContract::TABLE_NAME . " SET " . FiguraContract::COL_IMAGEN . " = :imagen, " . FiguraContract::COL_TIPO_IMAGEN . " = :tipo_imagen WHERE " . FiguraContract::COL_ID . " = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':imagen', $dao[FiguraContract::COL_IMAGEN], PDO::PARAM_LOB);
        $stmt->bindParam(':tipo_imagen', $dao[FiguraContract::COL_TIPO_IMAGEN], PDO::PARAM_STR);
        $stmt->bindParam(':id', $dao[FiguraContract::COL_ID], PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Implementación del método delete para eliminar una figura por su ID
    public function delete($id)
    {
        $sql = "DELETE FROM " . FiguraContract::TABLE_NAME . " WHERE " . FiguraContract::COL_ID . " = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}