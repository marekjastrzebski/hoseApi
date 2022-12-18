<?php
declare(strict_types=1);

namespace App\Request\Users;

use App\Repository\UsersRepository;
use App\Request\Core\UpdateRequest;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UpdateUserRequest extends UpdateRequest
{
	public function __construct(
		UsersRepository    $repository,
		ValidatorInterface $validator,
		ManagerRegistry    $registry,
		RequestStack       $request)
	{
		parent::__construct($repository, $validator, $registry, $request);
	}

	/**
	 * @return UsersRepository
	 */
	final public function getRepository(): UsersRepository
	{
		return $this->repository;
	}
}