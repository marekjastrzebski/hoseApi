<?php
declare(strict_types=1);

namespace App\Request\Core;

use App\Entity\EntityInterface;
use App\Repository\RepositoryInterface;
use Doctrine\ORM\EntityRepository;

abstract class GetRequest implements RequestInterface
{
	protected array $errors = [];
	protected EntityInterface|array|null $entity;
	public function __construct(protected readonly RepositoryInterface $repository)
	{
	}

	final public function getById(?int $id): self
	{
		$entity = $this->repository->find($id);
		if(!$entity){
			$this->errors[] = 'Could not find representation of id '.$id;
		}
		$this->entity = $entity;

		return $this;
	}

	final public function getAll()
	{
		$this->entity = $this->repository->findAll();

		return $this;
	}

	public function getErrors(): array
	{
		return $this->errors;
	}

	public function getEntity(): EntityInterface|array|null
	{
		return $this->entity;
	}

	public function getRepository(): EntityRepository
	{
		return $this->repository;
	}
}