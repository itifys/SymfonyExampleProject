<?php

namespace App\Repository;

use App\Entity\PlayInternal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PlayInternal|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlayInternal|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlayInternal[]    findAll()
 * @method PlayInternal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlayInternalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlayInternal::class);
    }

    // /**
    //  * @return PlayInternal[] Returns an array of PlayInternal objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PlayInternal
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
