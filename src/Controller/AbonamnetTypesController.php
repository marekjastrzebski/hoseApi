<?php
declare(strict_types=1);
namespace App\Controller;

use App\Enum\Execute;
use App\Request\AbonamentTypes\CreateAbonamentTypes;
use App\Request\AbonamentTypes\GetAbonamentTypes;
use App\Request\AbonamentTypes\UpdateAbonamentTypes;
use App\Request\Core\RequestExecutor;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class AbonamnetTypesController extends AbstractController
{
	public function __construct(private readonly RequestExecutor $executor)
	{
	}

	#[Route('/api/abonamentType', methods: ['POST'])]
	public function createAbonamentType(CreateAbonamentTypes $abonamentTypes): JsonResponse
	{
		$this->executor->persist($abonamentTypes);
		$this->executor->execute(Execute::CREATE);

		return new JsonResponse($this->executor->getResults(), $this->executor->getResponseCode());
	}

	#[Route('/api/abonamentType/{id}', methods: ['PATCH'])]
	public function updateAbonamentType(UpdateAbonamentTypes $abonamentTypes, int $id): JsonResponse
	{
		$this->executor->persist($abonamentTypes->setId($id));
		$this->executor->execute(Execute::UPDATE);

		return new JsonResponse($this->executor->getResults(), $this->executor->getResponseCode());
	}

	#[Route('/api/abonamentTypes', methods: ['GET'])]
	public function getAllAbonamentTypes(GetAbonamentTypes $abonamentTypes): JsonResponse
	{
		$this->executor->persist($abonamentTypes->getAll());
		$this->executor->execute(Execute::GET);

		return new JsonResponse($this->executor->getResults(), $this->executor->getResponseCode());
	}
}