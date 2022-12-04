<?php

namespace App\Entity;

use App\Repository\HorsesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HorsesRepository::class)]
class Horses
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?bool $contusion = null;

    #[ORM\Column(length: 255)]
    private ?string $picture = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $father = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $mother = null;

    #[ORM\OneToMany(mappedBy: 'horse', targetEntity: Contusions::class)]
    private Collection $contusions;

    #[ORM\Column(nullable: true)]
    private ?bool $remarks = null;

    public function __construct()
    {
        $this->contusions = new ArrayCollection();
    }

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

    public function isContusion(): ?bool
    {
        return $this->contusion;
    }

    public function setContusion(bool $contusion): self
    {
        $this->contusion = $contusion;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getFather(): ?string
    {
        return $this->father;
    }

    public function setFather(?string $father): self
    {
        $this->father = $father;

        return $this;
    }

    public function getMother(): ?string
    {
        return $this->mother;
    }

    public function setMother(?string $mother): self
    {
        $this->mother = $mother;

        return $this;
    }

    /**
     * @return Collection<int, Contusions>
     */
    public function getContusions(): Collection
    {
        return $this->contusions;
    }

    public function addContusion(Contusions $contusion): self
    {
        if (!$this->contusions->contains($contusion)) {
            $this->contusions->add($contusion);
            $contusion->setHorse($this);
        }

        return $this;
    }

    public function removeContusion(Contusions $contusion): self
    {
        if ($this->contusions->removeElement($contusion)) {
            // set the owning side to null (unless already changed)
            if ($contusion->getHorse() === $this) {
                $contusion->setHorse(null);
            }
        }

        return $this;
    }

    public function isRemarks(): ?bool
    {
        return $this->remarks;
    }

    public function setRemarks(?bool $remarks): self
    {
        $this->remarks = $remarks;

        return $this;
    }
}
