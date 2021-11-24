<?php declare(strict_types = 1);

namespace App\Entities;

use DateTime;

class Booking
{
    private $id;
    private $start_day;
    private $id_notice;
    private $notice;
    private $pax;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getStartDay(): DateTime
    {
        return $this->start_day;
    }

    public function setStartDay(DateTime $start_day): self
    {
        $this->start_day = $start_day;

        return $this;
    }

    public function getIdNotice(): string
    {
        return $this->id_notice;
    }

    public function setIdNotice(string $id_notice): self
    {
        $this->id_notice = $id_notice;

        return $this;
    }

    public function getNotice(): ?Notice
    {
        return $this->notice;
    }

    public function setNotice(Notice $notice)
    {
        $this->notice = $notice;

        return $this;
    }

    public function getPax(): ?array
    {
        return $this->pax;
    }

    public function setPax(array $pax): self
    {
        $this->pax = $pax;

        return $this;
    }
}
