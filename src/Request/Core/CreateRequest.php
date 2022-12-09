<?php
declare(strict_types=1);

namespace App\Request\Core;

use App\Entity\EntityInterface;
use App\Entity\Users;
use App\Validation\RequestValidation;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CreateRequest extends RequestValidation
{
	public function __construct(EntityInterface $entity, ValidatorInterface $validator, ManagerRegistry $registry)
	{
		parent::__construct($validator, $registry);
		$this->persist($entity);
	}
}