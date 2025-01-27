<?php

use Illuminate\Support\Facades\DB; 
use App\Contracts\ICrud;
/**
 * Tabla de relacion FiguraTablero de la bd
 * @author Melissa Ruiz
 */
class FiguraTableroDao implements ICrud {

    /**
     * Obtener todos los datos
     */
    public function findAll() {
        return DB::table('figuras_tableros')->get();
    }

    /**
     * Guardar los datos
     */
    public function save($dao) {

        $id = DB::table('figuras_tableros')->insertGetId([
            'figura_id' => $dao['figura_id'],
            'tablero_id' => $dao['tablero_id'],
            'posicion' => $dao['posicion'],
        ]);
        return $id; 
    }

    /**
     * Obtener un dato por su ID
     */
    public function findById($id) {
        return DB::table('figuras_tableros')->where('id', $id)->first();
    }


    /**
     * Actualizar los datos
     */ 
    public function update($dao) {
        return DB::table('figuras_tableros')->where('id', $dao['id'])->update([
            'figura_id' => $dao['figura_id'],
            'tablero_id' => $dao['tablero_id'],
            'posicion' => $dao['posicion'],
        ]);
    }

    /**
     * Eliminar un dato por su ID
     */
    public function delete($id) {
        return DB::table('figuras_tableros')->where('id', $id)->delete();
    }
}

?>
