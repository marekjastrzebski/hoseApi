<?php

namespace App\Entity;

use App\Repository\RidesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: RidesRepository::class)]
class Rides implements EntityInterface
{
	#[ORM\Id]
	#[ORM\GeneratedValue]
	#[ORM\Column]
	private ?int $id = null;

	#[ORM\Column(type: Types::DATE_MUTABLE)]
	#[Assert\NotBlank(message: 'Ride date have to be set')]
	private ?\DateTimeInterface $date = null;

	#[ORM\ManyToOne]
	#[ORM\JoinColumn(nullable: false)]
	private ?Users $trainer = null;

	#[ORM\Column]
	#[Assert\Type('bool', message: 'Ride status should be boolean (True or false)')]
	#[Assert\Choice(choices: [true, false])]
	private ?bool $cancelled = null;

	#[ORM\ManyToOne]
	#[ORM\JoinColumn(nullable: false)]
	private ?Abonaments $abonament = null;

	#[ORM\ManyToOne]
	private ?Horses $horse = null;


	public function getId(): ?int
	{
		return $this->id;
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

	public function getTrainer(): ?Users
	{
		return $this->trainer;
	}

	public function setTrainer(?Users $trainer): self
	{
		$this->trainer = $trainer;

		return $this;
	}

	public function isCancelled(): ?bool
	{
		return $this->cancelled;
	}

	public function setCancelled(bool $cancelled): self
	{
		$this->cancelled = $cancelled;

		return $this;
	}

	public function getAbonament(): ?Abonaments
	{
		return $this->abonament;
	}

	public function setAbonament(?Abonaments $abonament): self
	{
		$this->abonament = $abonament;

		return $this;
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
}
