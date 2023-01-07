<?php
declare(strict_types=1);
namespace App\Request\Abonaments;

use App\Repository\AbonamentsRepository;
use App\Request\Core\UpdateRequest;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UpdateAbonaments extends UpdateRequest
{
	public function __construct(
		AbonamentsRepository $repository,
		ValidatorInterface                    $validator,
		ManagerRegistry                       $registry,
		RequestStack                          $request
	)
	{
		parent::__construct($repository, $validator, $registry, $request);
	}
}