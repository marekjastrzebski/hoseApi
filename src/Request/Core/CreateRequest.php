<?php
declare(strict_types=1);

namespace App\Request\Core;

use App\Entity\EntityInterface;
use App\Validation\RequestValidation;
use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Validator\Validator\ValidatorInterface;

abstract class CreateRequest extends RequestValidation implements RequestInterface
{
	public function __construct(
		protected readonly EntityRepository $repository,
		EntityInterface                     $entity,
		ValidatorInterface                  $validator,
		ManagerRegistry                     $registry,
		RequestStack                        $request)
	{
		parent::__construct($validator, $registry, $request);
		$this->persist($entity);
		$this->validate();
	}

	public function getRepository(): EntityRepository
	{
		return $this->repository;
	}
}