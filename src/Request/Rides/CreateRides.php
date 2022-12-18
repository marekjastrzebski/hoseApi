<?php

namespace App\Request\Rides;

use App\Entity\EntityInterface;
use App\Entity\Rides;
use App\Repository\RepositoryInterface;
use App\Repository\RidesRepository;
use App\Request\Core\CreateRequest;
use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CreateRides extends CreateRequest
{
	public function __construct(private RidesRepository $repository, ValidatorInterface $validator, ManagerRegistry $registry, RequestStack $request)
	{
		parent::__construct((new Rides()), $validator, $registry, $request);
	}

	public function getRepository(): EntityRepository
	{
		return $this->repository;
	}
}