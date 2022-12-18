<?php

namespace App\Request\Roles;

use App\Repository\RolesRepository;
use App\Request\Core\UpdateRequest;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UpdateRoles extends UpdateRequest
{
	public function __construct(
		RolesRepository    $repository,
		ValidatorInterface $validator,
		ManagerRegistry    $registry,
		RequestStack       $request)
	{
		parent::__construct($repository, $validator, $registry, $request);
	}

}