<?php
declare(strict_types=1);

namespace App\Request\Core;

use App\Entity\EntityInterface;
use App\Entity\Users;
use App\Request\RequestInterface;
use App\Validation\RequestValidation;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Validator\Validator\ValidatorInterface;

abstract class CreateRequest extends RequestValidation implements RequestInterface
{
	public function __construct(EntityInterface $entity, ValidatorInterface $validator, ManagerRegistry $registry)
	{
		parent::__construct($validator, $registry);
		$this->persist($entity);
	}
}