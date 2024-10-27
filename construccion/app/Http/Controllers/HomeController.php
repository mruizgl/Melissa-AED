<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function login(Request $request)
    {
        
    }

    /**
            $this->filename = env('FILE_USERS');
            $this->fileUsernameIndex = env('FILE_USER_NAME_INDEX');


            try {
                $myPDO = DB::getPdo();
                $myPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $dao = new UsuarioDAO();
            } catch (PDOException $e) {
                $dao = new UsuarioFileDAO();
            }





-----
  //ubicarse al final del archivo:
              fseek($fp, 0, SEEK_END);
//tomar la posición actual:
            $posicion = ftell($fp);
  


----------------------
//desplazarse a una posición del fichero binario contando desde cero $offset sería
//la información que obtenemos del ficheor de índices
 fseek($fp, $offset, SEEK_SET)
  
  


----------------------
//leer fichero
$fp = fopen($fichero, 'rb');

------------------

  //ver una imagen en html en base64
      <img src="data:{{$mimeType}};base64,{{$base64Image}}"  />
---
    

     */
}
