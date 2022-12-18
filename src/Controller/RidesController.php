<?php
declare(strict_types=1);

namespace App\Controller;

use App\Enum\Execute;
use App\Request\Core\RequestExecutor;
use App\Request\Rides\CreateRides;
use App\Request\Rides\GetRides;
use App\Request\Rides\UpdateRides;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class RidesController extends AbstractController
{
	public function __construct(private readonly RequestExecutor $executor)
	{
	}

	#[Route('/api/ride', methods: ['POST'])]
	public function createRides(CreateRides $rides): JsonResponse
	{
		$this->executor->persist($rides);
		$this->executor->execute(Execute::CREATE);

		return new JsonResponse($this->executor->getResults(), $this->executor->getResponseCode());
	}

	#[Route('/api/ride/{id}', methods: ['PATCH'])]
	public function updateRides(UpdateRides $rides, int $id): JsonResponse
	{
		$this->executor->persist($rides->setId($id));
		$this->executor->execute(Execute::UPDATE);

		return new JsonResponse($this->executor->getResults(), $this->executor->getResponseCode());
	}

	#[Route('/api/ride/{id}', methods: ['GET'])]
	public function getRide(GetRides $rides, int $id): JsonResponse
	{
		$this->executor->persist($rides->getById($id));
		$this->executor->execute(Execute::GET);

		return new JsonResponse($this->executor->getResults(), $this->executor->getResponseCode());
	}

	#[Route('/api/rides/{date}', methods: ['GET'])]
	public function getRidesDaily(GetRides $rides, \DateTime $date): JsonResponse
	{
		$this->executor->persist($rides->getDaily($date));
		$this->executor->execute(Execute::GET);

		return new JsonResponse($this->executor->getResults(), $this->executor->getResponseCode());
	}

	#[Route('/api/rides/{start}/{end}', methods: ['GET'])]
	public function getRidesDateToDate(GetRides $rides, \DateTime $start, \DateTime $end): JsonResponse
	{
		$this->executor->persist($rides->getDateToDate($start, $end));
		$this->executor->execute(Execute::GET);

		return new JsonResponse($this->executor->getResults(), $this->executor->getResponseCode());
	}
}