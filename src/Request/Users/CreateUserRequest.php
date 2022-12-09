<?php
declare(strict_types=1);

namespace App\Request\Users;

use App\Entity\Users;
use App\Repository\UsersRepository;
use App\Request\Core\CreateRequest;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CreateUserRequest extends CreateRequest
{
	public function __construct(private readonly UsersRepository $repository,
								ValidatorInterface               $validator,
								ManagerRegistry                  $registry)
	{
		parent::__construct((new Users()), $validator, $registry);
	}

	/**
	 * @return UsersRepository
	 */
	final public function getRepository(): UsersRepository
	{
		return $this->repository;
	}
}