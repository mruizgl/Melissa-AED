<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Rol
{
    private int $id;
    private string $nombre;

    // Métodos getter y setter
    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;
        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    
}

