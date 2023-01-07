<?php
declare(strict_types=1);

namespace App\Request\Abonaments;

use App\Entity\Abonaments;
use App\Repository\AbonamentsRepository;
use App\Request\Core\CreateRequest;
use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CreateAbonaments extends CreateRequest
{
	public function __construct(
		AbonamentsRepository $repository,
		ValidatorInterface   $validator,
		ManagerRegistry      $registry,
		RequestStack         $request
	)
	{
		parent::__construct($repository, new Abonaments(), $validator, $registry, $request);
	}
}