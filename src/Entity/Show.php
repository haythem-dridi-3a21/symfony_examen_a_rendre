<?php

namespace App\Entity;

use App\Repository\ShowRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ShowRepository::class)]
#[ORM\Table(name: '`show`')]
class Show
{
    #[ORM\Id]
    #[ORM\Column]
    private ?int $numshow = null;

    #[ORM\Column]
    private ?int $nbrseat = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateshow = null;

    #[ORM\ManyToOne(inversedBy : 'shows')]
    private ?TheatrePlay $theatrePlay = null;

    public function getNumshow(): ?int
    {
        return $this->numshow;
    }

    public function setNumshow(int $numshow): static
    {
        $this->numshow = $numshow;

        return $this;
    }

    public function getNbrseat(): ?int
    {
        return $this->nbrseat;
    }

    public function setNbrseat(int $nbrseat): static
    {
        $this->nbrseat = $nbrseat;

        return $this;
    }

    public function getDateshow(): ?\DateTimeInterface
    {
        return $this->dateshow;
    }

    public function setDateshow(\DateTimeInterface $dateshow): static
    {
        $this->dateshow = $dateshow;

        return $this;
    }

    public function getTheatrePlay(): ?TheatrePlay
    {
        return $this->theatrePlay;
    }

    public function setTheatrePlay(?TheatrePlay $theatrePlay): static
    {
        $this->theatrePlay = $theatrePlay;

        return $this;
    }
}
