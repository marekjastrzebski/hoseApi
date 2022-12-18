<?php
declare(strict_types=1);
namespace App\Request\Abonaments;

use App\Repository\AbonamentsRepository;
use App\Repository\RepositoryInterface;
use App\Request\Core\GetRequest;

class GetAbonaments extends GetRequest
{
	public function __construct(AbonamentsRepository $repository)
	{
		parent::__construct($repository);
	}
}