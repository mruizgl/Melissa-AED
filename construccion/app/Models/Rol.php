<?php

namespace App\Models;

class Rol {
    private int $id;
    private string $nombre;



    /**
     * Get the value of nombre
     *
     * @return string
     */
    public function getNombre(): string
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @param string $nombre
     *
     * @return self
     */
    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of id
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @param int $id
     *
     * @return self
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }
}
