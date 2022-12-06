<?php
declare(strict_types=1);

namespace App\Trait;

trait RequestValidatorTrait
{
	public function getRelationProperties($entity): array
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

	public function extractParamName(string $getter): string
	{
		return lcfirst(mb_strcut($getter, 0,3));
	}

	public function extractRelationProperties(array $paramsList): array
	{
		$filter = function ($value){
			return str_contains($value, '\\');
		};

		return array_filter($paramsList, $filter);
	}
}