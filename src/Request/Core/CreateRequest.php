<?php
declare(strict_types=1);

namespace App\Request\Core;

use App\Entity\EntityInterface;
use App\Entity\Users;
use App\Validation\RequestValidation;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Validator\Validator\ValidatorInterface;

abstract class CreateRequest extends RequestValidation implements RequestInterface
{
	public function __construct(EntityInterface $entity, ValidatorInterface $validator, ManagerRegistry $registry, RequestStack $request)
	{
		parent::__construct($validator, $registry, $request);
		$this->persist($entity);
		$this->validate();
	}
}