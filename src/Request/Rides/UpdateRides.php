<?php
declare(strict_types=1);

namespace App\Request\Rides;

use App\Repository\RidesRepository;
use App\Request\Core\UpdateRequest;
use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UpdateRides extends UpdateRequest
{
	public function __construct(
								private readonly RidesRepository $repository,
								ValidatorInterface               $validator, ManagerRegistry $registry,
								RequestStack                     $request
	)
	{
		parent::__construct($validator, $registry, $request);
	}

	public function getRepository(): EntityRepository
	{
		return $this->repository;
	}
}