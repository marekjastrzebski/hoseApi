<?php
declare(strict_types=1);

namespace App\Controller;

use App\Enum\Execute;
use App\Request\Core\RequestExecutor;
use App\Request\Users\CreateUserRequest;
use App\Request\Users\GetUsers;
use App\Request\Users\UpdateUserRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class UsersController extends AbstractController
{
	public function __construct(private readonly RequestExecutor $executor)
	{
	}

	#[Route('/api/users', methods: ['POST'])]
	public function createUser(CreateUserRequest $user): JsonResponse
	{
		$this->executor->persist($user);
		$this->executor->execute(Execute::CREATE);

		return new JsonResponse($this->executor->getResults(), $this->executor->getResponseCode());
	}

	#[Route('/api/users/{id}', methods: ['PATCH'])]
	public function updateUser(UpdateUserRequest $user, int $id): JsonResponse
	{
		$this->executor->persist($user->setId($id));
		$this->executor->execute(Execute::UPDATE);

		return new JsonResponse($this->executor->getResults(), $this->executor->getResponseCode());
	}

	#[Route('/api/users/{id}', methods: ['GET'])]
	public function getUserById(GetUsers $user, int $id): JsonResponse
	{
		$this->executor->persist($user->getById($id));
		$this->executor->execute(Execute::GET);

		return new JsonResponse($this->executor->getResults(), $this->executor->getResponseCode());
	}

	#[Route('/api/users', methods: ['GET'])]
	public function getAllUsers(GetUsers $users): JsonResponse
	{
		$this->executor->persist($users->getAll());
		$this->executor->execute(Execute::GET);

		return new JsonResponse($this->executor->getResults(), $this->executor->getResponseCode());
	}
}
