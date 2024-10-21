<?php

use Illuminate\Support\Facades\DB;

class Rol {
    private string $nombre;
    private int $id;
}//meter en el modelo, esto es de ejemplo, hacer getter y setters

class RolDao implements ICrud
{
    public function __construct() {}
    public function findAll()
    {
        $myPDO = DB::getPdo();
        // FETCH_ASSOC
        $stmt = $myPDO->prepare("SELECT * FROM " . PersonaContract::TABLE_NAME);
        $stmt->setFetchMode(PDO::FETCH_ASSOC); //devuelve array asociativo
        $stmt->execute(); // Ejecutamos la sentencia
        $personas = [];
        while ($row = $stmt->fetch()) {
            $p = new Persona();
            $p->setId($row["id"])
                ->setNombre($row["nombre"])
                ->setEdad($row["edad"]);
            $personas[] = $p;
        }

        return $personas;
    }

    public function save($dao){}
    public function findById($id){}
    public function update($dao){}
    public function delete($id){}
}
