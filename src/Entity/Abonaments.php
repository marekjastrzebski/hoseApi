<?php

namespace App\Entity;

use App\Repository\AbonamentsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AbonamentsRepository::class)]
class Abonaments implements EntityInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?AbonamentTypes $type = null;

    #[ORM\OneToMany(mappedBy: 'abonament', targetEntity: Users::class)]
    private Collection $client;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $startDay = null;

    #[ORM\Column]
    private ?bool $renewable = null;

    #[ORM\Column(nullable: true)]
    private ?int $duration = null;

    #[ORM\OneToMany(mappedBy: 'abonament', targetEntity: Payments::class)]
    private Collection $payments;

    #[ORM\OneToMany(mappedBy: 'abonament', targetEntity: Rides::class)]
    private Collection $rides;

    public function __construct()
    {
        $this->client = new ArrayCollection();
        $this->payments = new ArrayCollection();
        $this->rides = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?AbonamentTypes
    {
        return $this->type;
    }

    public function setType(?AbonamentTypes $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, Users>
     */
    public function getClient(): Collection
    {
        return $this->client;
    }

    public function addClient(Users $client): self
    {
        if (!$this->client->contains($client)) {
            $this->client->add($client);
            $client->setAbonament($this);
        }

        return $this;
    }

    public function removeClient(Users $client): self
    {
        if ($this->client->removeElement($client)) {
            // set the owning side to null (unless already changed)
            if ($client->getAbonament() === $this) {
                $client->setAbonament(null);
            }
        }

        return $this;
    }

    public function getStartDay(): ?\DateTimeInterface
    {
        return $this->startDay;
    }

    public function setStartDay(\DateTimeInterface $startDay): self
    {
        $this->startDay = $startDay;

        return $this;
    }

    public function isRenewable(): ?bool
    {
        return $this->renewable;
    }

    public function setRenewable(bool $renewable): self
    {
        $this->renewable = $renewable;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(?int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * @return Collection<int, Payments>
     */
    public function getPayments(): Collection
    {
        return $this->payments;
    }

    public function addPayment(Payments $payment): self
    {
        if (!$this->payments->contains($payment)) {
            $this->payments->add($payment);
            $payment->setAbonament($this);
        }

        return $this;
    }

    public function removePayment(Payments $payment): self
    {
        if ($this->payments->removeElement($payment)) {
            // set the owning side to null (unless already changed)
            if ($payment->getAbonament() === $this) {
                $payment->setAbonament(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Rides>
     */
    public function getRides(): Collection
    {
        return $this->rides;
    }

    public function addRide(Rides $ride): self
    {
        if (!$this->rides->contains($ride)) {
            $this->rides->add($ride);
            $ride->setAbonament($this);
        }

        return $this;
    }

    public function removeRide(Rides $ride): self
    {
        if ($this->rides->removeElement($ride)) {
            // set the owning side to null (unless already changed)
            if ($ride->getAbonament() === $this) {
                $ride->setAbonament(null);
            }
        }

        return $this;
    }
}
