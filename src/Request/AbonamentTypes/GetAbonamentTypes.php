<?php
declare(strict_types=1);

namespace App\Request\AbonamentTypes;

use App\Repository\AbonamentTypesRepository;
use App\Request\Core\GetRequest;

class GetAbonamentTypes extends GetRequest
{
	public function __construct(AbonamentTypesRepository $repository)
	{
		parent::__construct($repository);
	}
}