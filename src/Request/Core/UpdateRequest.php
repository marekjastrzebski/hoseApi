<?php
declare(strict_types=1);

namespace App\Request\Core;

use App\Entity\EntityInterface;
use App\Entity\Users;
use App\Validation\RequestValidation;
use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Validator\Validator\ValidatorInterface;

abstract class UpdateRequest extends RequestValidation implements RequestInterface
{
	private int $id;

	public function __construct(ValidatorInterface $validator, ManagerRegistry $registry, RequestStack $request)
	{
		parent::__construct($validator, $registry, $request);
	}

	public function setId(int $id): self
	{
		$this->id = $id;
		$this->persist($this->getEntityById());
		$this->validate();

		return $this;
	}

	public function getEntityById(): ?EntityInterface
	{
		return $this->getRepository()
			->find($this->id);
	}

	abstract public function getRepository(): EntityRepository;
}