<?php

namespace App\Repository;

use App\Entity\PlayPhoto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PlayPhoto|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlayPhoto|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlayPhoto[]    findAll()
 * @method PlayPhoto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlayPhotoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlayPhoto::class);
    }

    // /**
    //  * @return PlayPhoto[] Returns an array of PlayPhoto objects
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
    public function findOneBySomeField($value): ?PlayPhoto
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
