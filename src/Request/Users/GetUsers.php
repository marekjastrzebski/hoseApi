<?php
declare(strict_types=1);

namespace App\Request\Users;

use App\Repository\RepositoryInterface;
use App\Repository\RolesRepository;
use App\Request\Core\GetRequest;

class GetUsers extends GetRequest
{
	public function __construct(UsersRepository $repository)
	{
		parent::__construct($repository);
	}
}