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
			if($value instanceof EntityInterface){
				$value = $this->fetchEntity($value);
			}
			$results[$field] = $value;
		}

		return $results;
	}

}