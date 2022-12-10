<?php
declare(strict_types=1);
namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UsersRepository::class)]
class Users implements EntityInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

	#[Assert\Regex(
         		pattern: '/[^AaĄąBbCcĆćDdEeĘęFfGgHhIiJjKkLlŁłMmNnŃńOoÓóPpRrSsŚśTtUuWwYyZzŹźŻż]/',
         		message: 'firstName should contain only letters',
         		match: false
         	)]
         	#[Assert\NotBlank(
         		message: 'firstName should not be empty'
         	)]
             #[ORM\Column(length: 20)]
             private ?string $firstName = null;

	#[Assert\Regex(
         		pattern: '/[^AaĄąBbCcĆćDdEeĘęFfGgHhIiJjKkLlŁłMmNnŃńOoÓóPpRrSsŚśTtUuWwYyZzŹźŻż]/',
         		message: 'lastName should contain only letters',
         		match: false
         	)]
         	#[Assert\NotBlank(
         		message: 'lastName should not be empty'
         	)]
             #[ORM\Column(length: 20)]
             private ?string $LastName = null;


	#[Assert\NotBlank(
         		message: 'phone should not be empty'
         	)]
         	#[Assert\Length(min: 9, max: 13,
         		minMessage: 'Passed phone is too short',
         		maxMessage: 'Passed phone is too long')]
             #[ORM\Column]
             private ?int $phone = null;


	#[Assert\Email(
         		message: 'email is not a valid email address',
         	)]
         	#[Assert\NotBlank(
         		message: 'email should not be empty'
         	)]
             #[ORM\Column(length: 100)]
             private ?string $email = null;

    #[ORM\Column(length: 500)]
    private ?string $password = null;

    #[ORM\ManyToOne(inversedBy: 'client')]
    private ?Abonaments $abonament = null;

    #[ORM\ManyToOne(inversedBy: 'users')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Roles $role = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->LastName;
    }

    public function setLastName(string $LastName): self
    {
        $this->LastName = $LastName;

        return $this;
    }

    public function getPhone(): ?int
    {
        return $this->phone;
    }

    public function setPhone(int $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

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

    public function getRole(): ?Roles
    {
        return $this->role;
    }

    public function setRole(?Roles $role): self
    {
        $this->role = $role;

        return $this;
    }
}
