<?php
declare(strict_types=1);

namespace App\Request\Users;

use App\Repository\UsersRepository;
use App\Request\Core\UpdateRequest;
use App\Request\RequestInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UpdateUserRequest extends UpdateRequest
{
	public function __construct(private readonly UsersRepository $repository,
								ValidatorInterface               $validator,
								ManagerRegistry                  $registry)
	{
		parent::__construct($validator, $registry);
	}

	/**
	 * @return UsersRepository
	 */
	final public function getRepository(): UsersRepository
	{
		return $this->repository;
	}
}