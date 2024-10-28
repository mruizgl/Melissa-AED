<?php

namespace App\Models;

class Usuario
{
    private int $id;
    private string $nombre;
    private string $password;
    private int $rolId;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;
        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function getRolId(): int
    {
        return $this->rolId;
    }

    public function setRolId(int $rolId): self
    {
        $this->rolId = $rolId;
        return $this;
    }
}
