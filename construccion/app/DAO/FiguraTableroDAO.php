<?php

use Illuminate\Support\Facades\DB; 
use App\Contracts\ICrud;

class FiguraTableroDao implements ICrud {

    public function findAll() {
        return DB::table('figuras_tableros')->get();
    }

    public function save($dao) {

        $id = DB::table('figuras_tableros')->insertGetId([
            'figura_id' => $dao['figura_id'],
            'tablero_id' => $dao['tablero_id'],
            'posicion' => $dao['posicion'],
        ]);
        return $id; 
    }

    public function findById($id) {
        return DB::table('figuras_tableros')->where('id', $id)->first();
    }


    public function update($dao) {
        return DB::table('figuras_tableros')->where('id', $dao['id'])->update([
            'figura_id' => $dao['figura_id'],
            'tablero_id' => $dao['tablero_id'],
            'posicion' => $dao['posicion'],
            // Agrega otros campos según sea necesario
        ]);
    }

    public function delete($id) {
        return DB::table('figuras_tableros')->where('id', $id)->delete();
    }
}

?>
