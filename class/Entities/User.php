<?php declare(strict_types = 1);

namespace App\Entities;

use DateTime;

class User
{
    private $id;
    private $firstname;
    private $lastname;
    private $email;
    private $birthday;
    private $cars;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail($email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getBirthday(): DateTime
    {
        return $this->birthday;
    }

    public function setBirthday(DateTime $birthday): self
    {
        $this->birthday = $birthday;

        return $this;
    }

    public function getCars(): ?array
    {
        return $this->cars;
    }

    public function setCars(array $cars): self
    {
        $this->cars = $cars;

        return $this;
    }
}
