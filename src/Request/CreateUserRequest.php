<?php
declare(strict_types=1);

namespace App\Request;

use App\Entity\Users;
use App\Validation\RequestValidation;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CreateUserRequest extends RequestValidation
{
	public function __construct(Users $entity, ValidatorInterface $validator, ManagerRegistry $registry)
	{
		parent::__construct($entity, $validator, $registry);
	}
}