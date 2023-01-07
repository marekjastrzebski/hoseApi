<?php
declare(strict_types=1);

namespace App\Request\Users;

use App\Entity\Users;
use App\Repository\UsersRepository;
use App\Request\Core\CreateRequest;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CreateUserRequest extends CreateRequest
{
	public function __construct(
		UsersRepository    $repository,
		ValidatorInterface $validator,
		ManagerRegistry    $registry,
		RequestStack       $request
	)
	{
		parent::__construct($repository, (new Users()), $validator, $registry, $request);
	}
}