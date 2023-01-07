<?php

namespace App\Request\Rides;

use App\Entity\Rides;
use App\Repository\RidesRepository;
use App\Request\Core\CreateRequest;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CreateRides extends CreateRequest
{
	public function __construct(
		RidesRepository    $repository,
		ValidatorInterface $validator,
		ManagerRegistry    $registry,
		RequestStack       $request
	)
	{
		parent::__construct($repository, (new Rides()), $validator, $registry, $request);
	}
}