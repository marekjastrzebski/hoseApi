<?php
declare(strict_types=1);

namespace App\Request\AbonamentTypes;

use App\Entity\AbonamentTypes;
use App\Repository\AbonamentTypesRepository;
use App\Request\Core\CreateRequest;
use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CreateAbonamentTypes extends CreateRequest
{
	public function __construct(
		AbonamentTypesRepository $repository,
		ValidatorInterface       $validator,
		ManagerRegistry          $registry,
		RequestStack             $request
	)
	{
		parent::__construct($repository, new AbonamentTypes(), $validator, $registry, $request);
	}
}