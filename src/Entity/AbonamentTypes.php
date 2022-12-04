<?php

namespace App\Entity;

use App\Repository\AbonamentTypesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AbonamentTypesRepository::class)]
class AbonamentTypes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $ridesQuantity = null;

    #[ORM\Column]
    private ?int $payPeriod = null;

    #[ORM\Column]
    private ?int $rideDuration = null;

    #[ORM\Column]
    private ?float $price = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getRidesQuantity(): ?int
    {
        return $this->ridesQuantity;
    }

    public function setRidesQuantity(int $ridesQuantity): self
    {
        $this->ridesQuantity = $ridesQuantity;

        return $this;
    }

    public function getPayPeriod(): ?int
    {
        return $this->payPeriod;
    }

    public function setPayPeriod(int $payPeriod): self
    {
        $this->payPeriod = $payPeriod;

        return $this;
    }

    public function getRideDuration(): ?int
    {
        return $this->rideDuration;
    }

    public function setRideDuration(int $rideDuration): self
    {
        $this->rideDuration = $rideDuration;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }
}
