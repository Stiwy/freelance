<?php

namespace App\Repository;

use App\Entity\CustomerId;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CustomerId|null find($id, $lockMode = null, $lockVersion = null)
 * @method CustomerId|null findOneBy(array $criteria, array $orderBy = null)
 * @method CustomerId[]    findAll()
 * @method CustomerId[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CustomerIdRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CustomerId::class);
    }

    // /**
    //  * @return CustomerId[] Returns an array of CustomerId objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CustomerId
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
