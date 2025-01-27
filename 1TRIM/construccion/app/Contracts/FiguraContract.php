<?php

namespace App\Contracts;

final class FiguraContract
{
    public const TABLE_NAME = "figuras";
    public const COL_ID = "id";
    public const COL_IMAGEN = "imagen";
    public const COL_TIPO_IMAGEN = "tipo_imagen";

    private function __construct() {}
}
