<?php

namespace App\Request\Roles;

use App\Repository\RolesRepository;
use App\Repository\UsersRepository;
use App\Request\Core\UpdateRequest;
use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UpdateRoles extends UpdateRequest
{
	public function __construct(private readonly RolesRepository $repository,
								ValidatorInterface               $validator,
								ManagerRegistry                  $registry,
								RequestStack                     $request)
	{
		parent::__construct($validator, $registry, $request);
	}

	/**
	 * @return UsersRepository
	 */
	final public function getRepository(): EntityRepository
	{
		return $this->repository;
	}
}