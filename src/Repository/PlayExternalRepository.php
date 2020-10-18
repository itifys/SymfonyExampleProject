<?php

namespace App\Repository;

use App\Entity\PlayExternal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PlayExternal|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlayExternal|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlayExternal[]    findAll()
 * @method PlayExternal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlayExternalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlayExternal::class);
    }

    // /**
    //  * @return PlayExternal[] Returns an array of PlayExternal objects
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
    public function findOneBySomeField($value): ?PlayExternal
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
