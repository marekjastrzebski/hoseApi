<?php

namespace App\Entity;

use App\Repository\ContusionsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContusionsRepository::class)]
class Contusions
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'contusions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Horses $horse = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $vet = null;

    #[ORM\Column(length: 5000)]
    private ?string $description = null;

    #[ORM\Column(length: 5000, nullable: true)]
    private ?string $recommendations = null;

    #[ORM\Column]
    private ?bool $active = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHorse(): ?Horses
    {
        return $this->horse;
    }

    public function setHorse(?Horses $horse): self
    {
        $this->horse = $horse;

        return $this;
    }

    public function getVet(): ?string
    {
        return $this->vet;
    }

    public function setVet(?string $vet): self
    {
        $this->vet = $vet;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getRecommendations(): ?string
    {
        return $this->recommendations;
    }

    public function setRecommendations(?string $recommendations): self
    {
        $this->recommendations = $recommendations;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }
}
