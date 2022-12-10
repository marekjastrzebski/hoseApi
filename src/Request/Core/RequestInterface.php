<?php
declare(strict_types=1);
namespace App\Request\Core;

use App\Entity\EntityInterface;
use Doctrine\ORM\EntityRepository;

interface RequestInterface
{
	public function getErrors(): array;
	public function getValidEntity(): ?EntityInterface;
	public function getRepository(): EntityRepository;
}