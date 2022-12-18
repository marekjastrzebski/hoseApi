<?php

namespace App\Entity;

use App\Repository\AbonamentTypesRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: AbonamentTypesRepository::class)]
class AbonamentTypes implements EntityInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
	#[Assert\NotBlank(message: 'Abonament name should not be empty')]
    private ?string $name = null;

    #[ORM\Column]
	#[Assert\NotBlank(message: 'Abonament quantity should not be empty')]
    private ?int $ridesQuantity = null;

    #[ORM\Column]
	#[Assert\NotBlank(message: 'Abonament pay period should not be empty')]
    private ?int $payPeriod = null;

    #[ORM\Column]
	#[Assert\NotBlank(message: 'Abonament duration should not be empty')]
    private ?int $rideDuration = null;

    #[ORM\Column]
	#[Assert\NotBlank(message: 'Abonament price should not be empty')]
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
