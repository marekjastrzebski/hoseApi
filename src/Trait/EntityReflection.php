<?php
declare(strict_types=1);

namespace App\Trait;

use App\Entity\EntityInterface;

trait EntityReflection
{
	public function getPropertiTypes(EntityInterface $entity): array
	{
		$reflection = new \ReflectionClass($entity);
		$relations = [];
		foreach ($reflection->getMethods() as $entitySetter) {
			try {
				if (!str_starts_with($entitySetter->getName(), 'get')) {
					continue;
				}
				$relations[$this->extractParamName($entitySetter->getName())] = $entitySetter->getReturnType()->getName();
			} catch (\ReflectionException $e) {
				continue;
			}
		}

		return $relations;
	}

	public function extractParamName(string $method): string
	{
		return match (str_starts_with($method, 'is')) {
			true => lcfirst(substr($method, 2)),
			default => lcfirst(substr($method, 3))
		};
	}

	public function extractRelationProperties(array $paramsList): array
	{
		$filter = function ($value) {
			return str_contains($value, '\\');
		};

		return array_filter($paramsList, $filter);
	}

	public function extractDateTimeProperties(array $paramsList): array
	{
		$filter = function ($value) {
			return str_contains($value, 'DateTimeInterface');
		};

		return array_filter($paramsList, $filter);
	}

	public function getRepositoryName(string $entityNameSpace): string
	{
		return str_replace('Entity', 'Repository', $entityNameSpace) . 'Repository';
	}

	public function getEntityGetters(EntityInterface $entity): array
	{
		$reflection = new \ReflectionClass($entity);
		$getters = [];
		foreach ($reflection->getMethods() as $entitySetter) {
			try {
				if (
					!str_starts_with($entitySetter->getName(), 'get')
					&& !str_starts_with($entitySetter->getName(), 'is')
				) {
					continue;
				}
				$getters[$this->extractParamName($entitySetter->getName())] = $entitySetter->getName();
			} catch (\ReflectionException $e) {
				continue;
			}
		}

		return $getters;
	}

	public function getClassType(EntityInterface $entity): string
	{
		$reflection = new \ReflectionClass($entity);

		return $reflection->getName();
	}
}