<?php

namespace App\Request\Roles;

use App\Repository\RolesRepository;
use App\Request\Core\CreateRequest;
use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CreateRole extends CreateRequest
{
	public function __construct(private readonly RolesRepository $repository,
								ValidatorInterface               $validator,
								ManagerRegistry                  $registry,
								RequestStack                          $request)
	{
		parent::__construct((new Roles()), $validator, $registry, $request);
	}
	public function getRepository(): EntityRepository
	{
		return $this->repository;
	}
}