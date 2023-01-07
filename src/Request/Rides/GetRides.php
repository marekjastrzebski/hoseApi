<?php
declare(strict_types=1);
namespace App\Request\Rides;

use App\Repository\RepositoryInterface;
use App\Repository\RidesRepository;
use App\Request\Core\GetRequest;

class GetRides extends GetRequest
{
	public function __construct(RidesRepository $repository)
	{
		parent::__construct($repository);
	}

	public function getDaily(\DateTime $date): self
	{
		$this->entity = $this->repository->getDaily($date);

		return $this;
	}

	public function getDateToDate(\DateTime $start, \DateTime $end): self
	{
		$dates = new \DatePeriod($start, new \DateInterval('P1D'), $end->modify('+ 1 day'));

		$this->entity = $this->repository->getByManyDates($this->listDatePeriod($dates));

		return $this;
	}

	public function getDailyWithPayments(\DateTime $date): self
	{
		$this->entity = $this->repository->getDailyWithPayments($date);
		return $this;
	}

	private function listDatePeriod(\DatePeriod $dates): array
	{
		$result = [];
		foreach ($dates as $date){
			$result[] = $date->format('Y-m-d H:i');
		}

		return $result;
	}
}