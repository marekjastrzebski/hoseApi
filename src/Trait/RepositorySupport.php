<?php
declare(strict_types=1);

namespace App\Trait;

use App\Entity\EntityInterface;
use Doctrine\Persistence\ManagerRegistry;

trait RepositorySupport
{
	use EntityReflection;

	public function __construct(private readonly ManagerRegistry $registry)
	{
	}

	/**
	 * @throws \JsonException
	 */
	public function getFilters(): ?array
	{
		return json_decode(file_get_contents(__DIR__ . '/Source/fetchFilter.json'), true, 512, JSON_THROW_ON_ERROR);
	}

	public function saveEntity(EntityInterface $entity): void
	{
		$this->registry->getManager()->persist($entity);

		$this->registry->getManager()->flush();
	}

	public function removeEntity(EntityInterface $entity): void
	{
		$this->registry->getManager()->remove($entity);

		$this->registry->getManager()->flush();
	}

	public function fetchEntity(?EntityInterface $entity): array
	{
		if(!$entity){
			return [];
		}
		$results = [];
		foreach ($this->getEntityGetters($entity) as $field => $getter) {
			$value = $entity->$getter();
			if(in_array($field, $this->getFilters(), true)){
				continue;
			}
			if($value instanceof \DateTime){
				$value = explode(' ',$value->format('Y-m-d H:i'));
			}
			if($value instanceof EntityInterface ){
				$value = $this->fetchEntity($value);
			}
			$results[$field] = $value;
		}

		return $results;
	}
}