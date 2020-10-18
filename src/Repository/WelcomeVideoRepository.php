<?php

namespace App\Repository;

use App\Entity\WelcomeVideo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method WelcomeVideo|null find($id, $lockMode = null, $lockVersion = null)
 * @method WelcomeVideo|null findOneBy(array $criteria, array $orderBy = null)
 * @method WelcomeVideo[]    findAll()
 * @method WelcomeVideo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WelcomeVideoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WelcomeVideo::class);
    }

    // /**
    //  * @return WelcomeVideo[] Returns an array of WelcomeVideo objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?WelcomeVideo
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
