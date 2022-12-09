<?php
declare(strict_types=1);

namespace App\Request\Core;

use App\Entity\EntityInterface;
use App\Entity\Users;
use App\Validation\RequestValidation;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UpdateRequest extends RequestValidation
{
	private int $id;
	private string $repositoryClass;

	public function __construct(ValidatorInterface $validator, ManagerRegistry $registry)
	{
		parent::__construct($validator, $registry);
	}

	public function updateId(int $id): void
	{
		$this->id = $id;
		$this->persist($this->getEntityById());
	}

	protected function setRepositoryClass(string $repositoryClass)
	{
		$this->repositoryClass = $repositoryClass;
	}

	protected function getEntityById(): ?EntityInterface
	{
		$entity = $this->registry
			->getRepository($this->repositoryClass)
			->find($this->id);

		return $entity;
	}
}