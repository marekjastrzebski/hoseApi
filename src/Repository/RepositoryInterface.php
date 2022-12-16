<?php
declare(strict_types=1);
namespace App\Repository;

use App\Entity\EntityInterface;
use Doctrine\ORM\EntityRepository;

interface RepositoryInterface
{
	public function fetchEntity(?EntityInterface $entity):?array;
}