<?php

namespace App\Repository;

use App\Entity\Rides;
use App\Trait\RepositorySupport;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Rides>
 *
 * @method Rides|null find($id, $lockMode = null, $lockVersion = null)
 * @method Rides|null findOneBy(array $criteria, array $orderBy = null)
 * @method Rides[]    findAll()
 * @method Rides[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RidesRepository extends ServiceEntityRepository implements RepositoryInterface
{
	use RepositorySupport;
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Rides::class);
    }

    public function save(Rides $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Rides $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

	public function getDaily(\DateTime $date): ?array
	{
		return $this->findBy(['date' => $date]);
	}

	public function getByManyDates(array $dates): ?array
	{
		return $this->findBy(['date' => $dates]);
	}

//    /**
//     * @return Rides[] Returns an array of Rides objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Rides
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
