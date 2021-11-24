<?php declare(strict_types = 1);

namespace App\Entities;

class Notice
{
    private $id;
    private $text;
    private $start_city;
    private $end_city;
    private $id_user_creator;
    private $creator;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getStartCity(): ?string
    {
        return $this->start_city;
    }

    public function setStartCity(string $start_city): self
    {
        $this->start_city = $start_city;

        return $this;
    }

    public function getEndCity(): ?string
    {
        return $this->end_city;
    }

    public function setEndCity(string $end_city): self
    {
        $this->end_city = $end_city;

        return $this;
    }

    public function getUserCreator(): ?string
    {
        return $this->id_user_creator;
    }

    public function setUserCreator(string $id_user_creator): self
    {
        $this->id_user_creator = $id_user_creator;

        return $this;
    }

    public function getCreator(): ?User
    {
        return $this->creator;
    }

    public function setCreator(User $creator): self
    {
        $this->creator = $creator;

        return $this;
    }
}
