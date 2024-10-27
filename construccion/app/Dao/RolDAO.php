<?php

use App\Contracts\RolContract;
use App\Models\Rol;
use Illuminate\Support\Facades\DB;


class RolDao implements ICrud
{
    public function __construct() {}
    public function findAll()
    {
        $myPDO = DB::getPdo();
        // FETCH_ASSOC
        $stmt = $myPDO->prepare("SELECT * FROM " . RolContract::TABLE_NAME);
        $stmt->setFetchMode(PDO::FETCH_ASSOC); //devuelve array asociativo
        $stmt->execute(); // Ejecutamos la sentencia
        $roles = [];
        while ($row = $stmt->fetch()) {
            $r = new Rol();
            $r->setId($row["id"])
                ->setNombre($row["nombre"]);
            $roles[] = $r;
        }

        return $roles;
    }

    public function save($dao){}
    public function findById($id){}
    public function update($dao){}
    public function delete($id){}
    //dao->figuraDAO, rolDAO, tableroDAO, usuarioDAO. contract->FiguraContract, RolContract, TableroContract, UsuarioContract. MODELOS.> Figura, Rol, Tablero, User, usuario
    //verificar una pass:
        //Hash::check($passwordEnTextoPlano, $usuario->getPassword() )
        //$usuario->setPassword(Hash::make($request->passwordTextoPlano))
}
