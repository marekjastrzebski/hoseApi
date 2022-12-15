<?php
declare(strict_types=1);
namespace App\Request\Roles;

use App\Repository\RolesRepository;
use App\Request\Core\GetRequest;

class GetRoles extends GetRequest
{
	public function __construct(RolesRepository $repository)
	{
		parent::__construct($repository);
	}
}