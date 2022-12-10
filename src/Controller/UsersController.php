<?php
declare(strict_types=1);

namespace App\Controller;

use App\Request\Core\RequestExecutor;
use App\Request\Users\CreateUserRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class UsersController extends AbstractController
{
	public function __construct(private readonly RequestExecutor $executor)
	{
	}

	#[Route('/api/users', methods:['POST'])]
	public function createUser(CreateUserRequest $user): JsonResponse
	{
		$this->executor->persist($user);
		$this->executor->execute();

		return new JsonResponse($this->executor->getResults(), $this->executor->getResponseCode());
	}


}