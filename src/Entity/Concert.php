<?php

namespace App\Entity;

use App\Repository\ConcertRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ConcertRepository::class)
 */
class Concert
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Band::class, inversedBy="concerts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $band;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tour_name;

    /**
     * @ORM\ManyToOne(targetEntity=Hall::class, inversedBy="concerts")
     * @ORM\JoinColumn(nullable=true)
     */
    private $hall;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBand(): ?band
    {
        return $this->band;
    }

    public function setBand(?Band $band): self
    {
        $this->band = $band;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getTourName(): ?string
    {
        return $this->tour_name;
    }

    public function setTourName(?string $tour_name): self
    {
        $this->tour_name = $tour_name;

        return $this;
    }

    public function getHall(): ?hall
    {
        return $this->hall;
    }

    public function setHall(?Hall $hall): self
    {
        $this->hall = $hall;

        return $this;
    }
}
