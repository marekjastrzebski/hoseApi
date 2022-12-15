<?php
declare(strict_types=1);
namespace App\Controller;

use App\Enum\Execute;
use App\Request\Core\RequestExecutor;
use App\Request\Roles\CreateRole;
use App\Request\Roles\GetRoles;
use App\Request\Roles\UpdateRoles;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class RolesController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{
	public function __construct(private readonly RequestExecutor $executor)
	{
	}

	#[Route('/api/roles', methods: ['POST'])]
	public function createRole(CreateRole $role): JsonResponse
	{
		$this->executor->persist($role);
		$this->executor->execute(Execute::CREATE);

		return new JsonResponse($this->executor->getResults(), $this->executor->getResponseCode());
	}

	#[Route('/api/roles/{id}', methods: ['PATCH'])]
	public function updateRole(UpdateRoles $role, int $id): JsonResponse
	{
		$this->executor->persist($role->setId($id));
		$this->executor->execute(Execute::UPDATE);

		return new JsonResponse($this->executor->getResults(), $this->executor->getResponseCode());
	}

	#[Route('/api/roles/{id}', methods: ['GET'])]
	public function getRole(GetRoles $role, int $id): JsonResponse
	{
		$this->executor->persist($role->getById($id));
		$this->executor->execute(Execute::GET);

		return new JsonResponse($this->executor->getResults(), $this->executor->getResponseCode());
	}

	#[Route('/api/roles', methods: ['GET'])]
	public function getAllRoles(GetRoles $roles): JsonResponse
	{
		$this->executor->persist($roles->getAll());
		$this->executor->execute(Execute::GET);

		return new JsonResponse($this->executor->getResults(), $this->executor->getResponseCode());
	}
}