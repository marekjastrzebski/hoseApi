<?php
declare(strict_types=1);
namespace App\Controller;

use App\Enum\Execute;
use App\Enum\MethodPrefix;
use App\Request\Abonaments\CreateAbonaments;
use App\Request\Abonaments\GetAbonaments;
use App\Request\Abonaments\UpdateAbonaments;
use App\Request\Core\RequestExecutor;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class AbonamentsController extends AbstractController
{
	public function __construct(private readonly RequestExecutor $executor)
	{
	}

	#[Route('/api/abonament', methods: ['POST'])]
	public function createAbonament(CreateAbonaments $abonaments): JsonResponse
	{
		$this->executor->persist($abonaments);
		$this->executor->execute(Execute::CREATE);

		return new JsonResponse($this->executor->getResults(), $this->executor->getResponseCode());
	}

	#[Route('/api/abonament/{id}', methods: ['PATCH'])]
	public function updateAbonament(UpdateAbonaments $abonaments, int $id): JsonResponse
	{
		$this->executor->persist($abonaments->setId($id));
		$this->executor->execute(Execute::UPDATE);

		return new JsonResponse($this->executor->getResults(), $this->executor->getResponseCode());
	}

	#[Route('/api/abonament/{id}', methods: ['GET'])]
	public function getAbonament(GetAbonaments $abonaments, int $id): JsonResponse
	{
		$this->executor->persist($abonaments->getById($id));
		$this->executor->execute(Execute::GET);

		return new JsonResponse($this->executor->getResults(), $this->executor->getResponseCode());
	}

}