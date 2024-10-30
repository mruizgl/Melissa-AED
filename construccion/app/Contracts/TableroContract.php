<?php

namespace App\Contracts;

final class TableroContract
{
    public const TABLE_NAME = "tableros";
    public const COL_ID = "id";
    public const COL_USUARIO_ID = "usuario_id";
    public const COL_NOMBRE = "nombre";
    public const COL_CONTENIDO = "contenido";
    public const COL_FECHA = "fecha";

    private function __construct() {}
}
