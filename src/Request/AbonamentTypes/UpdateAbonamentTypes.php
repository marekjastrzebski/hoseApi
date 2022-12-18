<?php
declare(strict_types=1);

namespace App\Request\AbonamentTypes;

use App\Repository\AbonamentTypesRepository;
use App\Request\Core\UpdateRequest;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UpdateAbonamentTypes extends UpdateRequest
{
	public function __construct(
		AbonamentTypesRepository $repository,
		ValidatorInterface       $validator,
		ManagerRegistry          $registry,
		RequestStack             $request)
	{
		parent::__construct($repository, $validator, $registry, $request);
	}


}