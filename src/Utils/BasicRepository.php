<?php
declare(strict_types=1);

namespace App\Utils;

use App\Entity\EntityInterface;
use Doctrine\Persistence\ManagerRegistry;

class BasicRepository
{
	public function __construct(private readonly ManagerRegistry $registry)
	{
	}

	public function save(EntityInterface $entity): void
	{
		$this->registry->getManager()->persist($entity);

		$this->registry->getManager()->flush();
	}

	public function remove(EntityInterface $entity): void
	{
		$this->registry->getManager()->remove($entity);

		$this->registry->getManager()->flush();
	}
}