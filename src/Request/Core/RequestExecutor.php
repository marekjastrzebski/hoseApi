<?php
declare(strict_types=1);

namespace App\Request\Core;

use App\Enum\Execute;
use Symfony\Component\HttpFoundation\Response;

class RequestExecutor
{
	private RequestInterface $requestEntity;
	private int $responseCode = Response::HTTP_OK;
	private array $results = [];

	public function persist(RequestInterface $request): void
	{
		$this->requestEntity = $request;
	}

	public function execute(Execute $executeMode): void
	{

		if (!empty($this->requestEntity->getErrors())) {
			$this->responseCode = Response::HTTP_BAD_REQUEST;
			return;
		}
		if (!$this->requestEntity->getEntity()) {
			$this->responseCode = Response::HTTP_NO_CONTENT;
			return;
		}
		match ($executeMode) {
			Execute::CREATE, Execute::UPDATE => $this->requestEntity->getRepository()->save($this->requestEntity->getEntity(), true),
			default => null
		};
	}

	public function getResults(): array
	{
		if (!empty($this->requestEntity->getErrors())) {
			return $this->requestEntity->getErrors();
		}

		return $this->fetchResults();
	}

	private function fetchResults(): array
	{
		$results[] = $this->requestEntity->getRepository()->getOneById($this->requestEntity->getEntity()->getId());

		return $results;
	}

	/**
	 * @return int
	 */
	public function getResponseCode(): int
	{
		return $this->responseCode;
	}
}