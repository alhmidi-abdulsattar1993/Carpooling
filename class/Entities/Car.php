<?php

namespace App\Entities;

class Car
{
    private $id;
    private $brand;
    private $model;
    private $color;
    private $nbrSlots;
    private $id_uesr;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getBrand(): string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getModel(): string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getNbrSlots(): int
    {
        return $this->nbrSlots;
    }

    public function setNbrSlots(int $nbrSlots): self
    {
        $this->nbrSlots = $nbrSlots;

        return $this;
    }
    /**
     * Get the value of id_uesr
     */
    public function getIdUesr()
    {
        return $this->id_uesr;
    }

    /**
     * Set the value of id_uesr
     *
     * @return  self
     */
    public function setIdUesr($id_uesr)
    {
        $this->id_uesr = $id_uesr;

        return $this;
    }
}
