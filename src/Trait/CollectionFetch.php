<?php
declare(strict_types=1);

namespace App\Trait;

use Doctrine\Common\Collections\Collection;
use Symfony\Bridge\Doctrine\ManagerRegistry;

trait CollectionFetch
{
	use EntityReflection;

	public function fetchCollection(array $entity, array $calledCollection): array
	{
		if (empty($calledCollection)) {
			return $entity;
		}
		$results = [];
		foreach ($entity as $field => $value) {
			if (is_array($value)) {
				$results[$field] = $this->fetchCollection($value, $calledCollection);
				continue;
			}
			if ($value instanceof Collection) {
				$results[] = $this->fetch($value, $calledCollection);
				continue;
			}
			$results[] = $value;
		}

		return $results;
	}

	private function fetch(?Collection $value, array $calledCollection): array
	{
		$return = [];
		foreach ($calledCollection as $call) {
			$function = $call['function'];
			$fields = $call['fields'];
			$results = [];
			foreach ($value->$function() as $element) {
				$results[] = $this->getFields($element, $fields);
			}
			$return[] = $results;
		}

		return $return;
	}

	private function getFields(string $entity, array $fields): array
	{
		assert($this->registry instanceof ManagerRegistry);
		$fullEntity = $this->registry->getRepository($this->getClassType($entity))->find($entity->getId());
		$entityCall = $this->getClassType($entity);
		$getters = $this->getEntityGetters(new $entityCall);
		$results = [];
		foreach ($fields as $field) {
			$getter = $getters[$field];
			$results[] = $fullEntity->$getter();
		}

		return $results;
	}

	public function saveValue(string $fieldName, mixed $value, array $calledCollection): mixed
	{
		if (!array_key_exists($fieldName, $calledCollection)) {
			return $value;
		}
	}
}