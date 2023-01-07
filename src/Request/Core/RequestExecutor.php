<?php
declare(strict_types=1);

namespace App\Request\Core;

use App\Entity\EntityInterface;
use App\Enum\Execute;
use App\Trait\CollectionFetch;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;

class RequestExecutor
{
	use CollectionFetch;

	private RequestInterface $requestEntity;
	private int $responseCode = Response::HTTP_OK;
	private array $collections = [];
	private array $results = [];

	public function __construct(private readonly ManagerRegistry $registry)
	{
	}

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

	/**
	 * Use this method to fetch collections from fetching entity;
	 * Use this method before calling getResults;
	 *
	 * @param string $fieldName - type name of field that contains collection
	 * @param string $collectionCall - type callback method to use on collection (last, first, toArray, getValues)
	 * @param array $selectedFields - type fields that you want to fetch from collected entity;
	 * do not call relational fields, it may provoke infant loop
	 * @return self
	 */
	public function callCollection(string $fieldName, string $collectionCall, array $selectedFields): self
	{
		$this->collections[$fieldName] = [
			'function' => $collectionCall,
			'fields' => $selectedFields
		];

		return $this;
	}

	public function getResults(): array
	{
		if (!empty($this->requestEntity->getErrors())) {
			return $this->requestEntity->getErrors();
		}
		$results = $this->fetchResults($this->requestEntity->getEntity());

		return $this->fetchCollection($results, $this->collections);
	}

	private function fetchResults(array|EntityInterface $entity): array
	{
		$results = [];
		if (!is_array($entity)) {
			$results[] = $this->requestEntity->getRepository()->fetchEntity($entity);

			return $results;
		}
		foreach ($this->requestEntity->getEntity() as $key => $entity) {
			if (is_array($entity)) {
				$results[$key] = $this->fetchResults($entity);
				continue;
			}
			$results[] = $this->requestEntity->getRepository()->fetchEntity($entity);
		}

		return $results;
	}

	public function getResponseCode(): int
	{
		return $this->responseCode;
	}
}